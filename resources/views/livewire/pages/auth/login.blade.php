<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public LoginForm $form;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: false);
    }
}; ?>

<div class="w-full max-w-[410px] bg-white rounded-2xl shadow-2xl overflow-hidden border border-gray-100/50">
    <div class="pt-8 px-8 pb-6">
        <!-- Logo Kota Pariaman -->
        <div class="flex justify-center mb-4">
            <div class="p-2.5 bg-[#F8FAFC] rounded-xl border border-gray-100 shadow-sm flex items-center justify-center">
                <img src="{{ asset('images/pariaman_logo.png') }}" alt="Logo Kota Pariaman" class="h-14 w-auto object-contain">
            </div>
        </div>

        <!-- Header Title & Subtitle -->
        <div class="text-center mb-6">
            <h1 class="text-3xl font-extrabold text-[#062447] tracking-tight">ELDR</h1>
            <p class="text-sm font-semibold text-gray-600 mt-0.5">Elektronik Legal Dokumen Review</p>
            <div class="mt-2.5">
                <span class="inline-block bg-[#1E3A66] text-white text-[10px] font-bold px-3.5 py-1 rounded-full tracking-wider uppercase shadow-sm">
                    DISKOMINFO KOTA PARIAMAN
                </span>
            </div>
        </div>

        <!-- Session Status Alert -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form wire:submit="login" class="space-y-4">
            <!-- Username / NIP / NIK -->
            <div>
                <label for="email" class="flex items-center text-xs font-semibold text-gray-700 mb-1.5 gap-1.5">
                    <svg class="w-3.5 h-3.5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    <span>Username (NIP/NIK)</span>
                </label>
                <input wire:model="form.email" id="email" type="text" name="email" required autofocus
                       placeholder="Masukkan NIP atau NIK"
                       class="w-full px-3.5 py-2.5 bg-[#F3F4F6] border border-gray-200 rounded-lg text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:bg-white focus:border-[#062447] focus:ring-2 focus:ring-[#062447]/20 transition-all">
                <x-input-error :messages="$errors->get('form.email')" class="mt-1 text-xs" />
            </div>

            <!-- Password with Eye Icon Toggle -->
            <div x-data="{ showPassword: false }">
                <label for="password" class="flex items-center text-xs font-semibold text-gray-700 mb-1.5 gap-1.5">
                    <svg class="w-3.5 h-3.5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                    <span>Password</span>
                </label>
                <div class="relative">
                    <input wire:model="form.password" x-ref="pwdInput" id="password" type="password" name="password" required
                           placeholder="••••••••"
                           class="w-full px-3.5 py-2.5 pr-10 bg-[#F3F4F6] border border-gray-200 rounded-lg text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:bg-white focus:border-[#062447] focus:ring-2 focus:ring-[#062447]/20 transition-all">
                    <button type="button" @click="showPassword = !showPassword; $refs.pwdInput.type = showPassword ? 'text' : 'password'" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600 focus:outline-none cursor-pointer">
                        <svg x-show="!showPassword" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                        <svg x-show="showPassword" x-cloak class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858-5.908a10.04 10.04 0 013.682-.763c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21M3 3l18 18" />
                        </svg>
                    </button>
                </div>
                <x-input-error :messages="$errors->get('form.password')" class="mt-1 text-xs" />
            </div>

            <!-- Submit Button -->
            <button type="submit" class="w-full bg-[#062447] hover:bg-[#0A3363] active:bg-[#041933] text-white font-bold py-3 px-4 rounded-lg shadow-md hover:shadow-lg transition-all text-sm flex items-center justify-center cursor-pointer mt-2">
                Masuk
            </button>
        </form>

        <!-- Lupa Password -->
        <div class="mt-5 text-center text-xs text-gray-500">
            Lupa Password? <a href="mailto:diskominfo@pariamankota.go.id" class="font-bold text-gray-800 hover:underline">Hubungi Admin</a>
        </div>
    </div>

    <!-- Bottom Bar Divider -->
    <div class="bg-[#F9FAFB] border-t border-gray-100 px-6 py-2.5 flex items-center justify-between text-[11px] text-gray-500">
        <div class="flex items-center gap-1.5">
            <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
            </svg>
            <span>Secure Portal</span>
        </div>
        <span class="font-mono text-gray-400">v2.4.0</span>
    </div>
</div>
