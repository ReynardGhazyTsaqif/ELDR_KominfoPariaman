<x-app-layout>
    @if(Auth::user() && Auth::user()->hasRole('super_admin'))
        @include('dashboards.super-admin')
    @else
        @include('dashboards.admin-opd')
    @endif
</x-app-layout>
