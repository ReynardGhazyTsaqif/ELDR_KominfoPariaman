<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\Models\Subjek;
use App\Models\PengajuanDokumen;
use App\Services\SubjekService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    protected SubjekService $subjekService;

    public function __construct(SubjekService $subjekService)
    {
        $this->subjekService = $subjekService;
    }

    private function authorizeSuperAdmin(): void
    {
        $user = Auth::user();
        if (!$user || !$user->hasRole('super_admin')) {
            abort(403, 'Anda tidak memiliki hak akses sebagai Super Administrator.');
        }
    }

    /**
     * Display a listing of users with search, filter, and pagination.
     */
    public function index(Request $request)
    {
        $this->authorizeSuperAdmin();

        $search = $request->input('search');
        $roleFilter = $request->input('role');

        $query = User::with(['roles', 'subjek']);

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('username', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        if ($roleFilter) {
            $query->whereHas('roles', function ($q) use ($roleFilter) {
                $q->where('name', $roleFilter);
            });
        }

        $users = $query->orderBy('id', 'desc')->paginate(10)->withQueryString();

        // KPI Counts
        $totalUsers = User::count();
        $activeUsers = User::where('is_active', true)->count();
        $inactiveUsers = User::where('is_active', false)->count();
        $opdCount = User::role('admin_opd')->count();
        $desaCount = User::role('admin_desa')->count();

        $roles = Role::all();

        return view('users.index', [
            'users' => $users,
            'totalUsers' => $totalUsers,
            'activeUsers' => $activeUsers,
            'inactiveUsers' => $inactiveUsers,
            'opdCount' => $opdCount,
            'desaCount' => $desaCount,
            'roles' => $roles,
            'search' => $search,
            'roleFilter' => $roleFilter,
        ]);
    }

    /**
     * Store a newly created user.
     */
    public function store(StoreUserRequest $request)
    {
        $this->authorizeSuperAdmin();

        try {
            $user = User::create([
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'tipe_login' => $request->input('tipe_login', 'pegawai'),
                'is_active' => true,
                'email_verified_at' => now(),
            ]);

            $user->assignRole($request->role);

            // Auto-sync d_subjek record via SubjekService
            $this->subjekService->findOrCreateForUser($user);

            return redirect()->route('users.index')
                ->with('success', "Pengguna '{$user->name}' berhasil ditambahkan!");
        } catch (\Exception $e) {
            return redirect()->route('users.index')
                ->with('error', 'Gagal menambahkan pengguna: ' . $e->getMessage());
        }
    }

    /**
     * Update the specified user.
     */
    public function update(UpdateUserRequest $request, $id)
    {
        $this->authorizeSuperAdmin();

        $user = User::findOrFail($id);

        try {
            $data = [
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'tipe_login' => $request->input('tipe_login', $user->tipe_login),
            ];

            if ($request->filled('password')) {
                $data['password'] = Hash::make($request->password);
            }

            $user->update($data);
            $user->syncRoles([$request->role]);

            // Re-sync d_subjek record
            $this->subjekService->findOrCreateForUser($user);

            return redirect()->route('users.index')
                ->with('success', "Data pengguna '{$user->name}' berhasil diperbarui!");
        } catch (\Exception $e) {
            return redirect()->route('users.index')
                ->with('error', 'Gagal memperbarui pengguna: ' . $e->getMessage());
        }
    }

    /**
     * Toggle active status of a user (soft deactivate).
     */
    public function toggleStatus($id)
    {
        $this->authorizeSuperAdmin();

        $user = User::findOrFail($id);

        if ($user->id === Auth::id()) {
            return redirect()->route('users.index')
                ->with('error', 'Anda tidak dapat menonaktifkan akun sendiri.');
        }

        try {
            $newStatus = !$user->is_active;
            $user->is_active = $newStatus;
            $user->save();

            $statusText = $newStatus ? 'diaktifkan' : 'dinonaktifkan';

            return redirect()->route('users.index')
                ->with('success', "Status akun '{$user->name}' berhasil {$statusText}.");
        } catch (\Exception $e) {
            return redirect()->route('users.index')
                ->with('error', 'Gagal mengubah status pengguna: ' . $e->getMessage());
        }
    }

    /**
     * Delete user with FK protection.
     */
    public function destroy($id)
    {
        $this->authorizeSuperAdmin();

        $user = User::findOrFail($id);

        if ($user->id === Auth::id()) {
            return redirect()->route('users.index')
                ->with('error', 'Anda tidak dapat menghapus akun sendiri.');
        }

        // Check FK Constraint: Prevent delete if user has submitted or verified documents in ff_pengajuan_dokumen
        if ($user->subjek_key) {
            $isUsed = PengajuanDokumen::where('subjek_key', $user->subjek_key)->exists();

            if ($isUsed) {
                return redirect()->route('users.index')
                    ->with('error', "User '{$user->name}' tidak dapat dihapus karena terhubung dengan riwayat pengajuan dokumen. Silakan nonaktifkan akun.");
            }
        }

        try {
            $name = $user->name;
            $subjekKey = $user->subjek_key;

            $user->delete();

            if ($subjekKey) {
                Subjek::destroy($subjekKey);
            }

            return redirect()->route('users.index')
                ->with('success', "Akun pengguna '{$name}' berhasil dihapus.");
        } catch (\Exception $e) {
            return redirect()->route('users.index')
                ->with('error', 'Gagal menghapus pengguna: ' . $e->getMessage());
        }
    }
}
