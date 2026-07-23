<x-app-layout>
    @if(Auth::user() && Auth::user()->hasRole('super_admin'))
        @include('dashboards.super-admin')
    @elseif(Auth::user() && Auth::user()->hasRole('kabag_hukum'))
        @include('dashboards.kabag-hukum')
    @elseif(Auth::user() && Auth::user()->hasRole('admin_hukum'))
        @include('dashboards.admin-hukum')
    @else
        @include('dashboards.admin-opd')
    @endif
</x-app-layout>
