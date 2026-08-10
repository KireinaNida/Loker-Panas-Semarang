@extends('layouts.site')

@section('title', 'Pengaturan Profil - Info Loker Panas')

@section('content')

    <div class="max-w-4xl mx-auto px-4 sm:px-6 py-8">
        <!-- Breadcrumb & Header -->
        <div class="mb-6">
            <div class="flex items-center gap-2 text-xs font-medium text-panas-dark/50 mb-2">
                <a href="{{ route('beranda') }}" class="hover:text-panas-ember transition-colors">Beranda</a>
                <span>/</span>
                <span class="text-panas-dark font-semibold">Pengaturan Profil</span>
            </div>
            <h1 class="font-display text-2xl sm:text-3xl font-extrabold text-panas-dark">Profil Saya</h1>
            <p class="text-sm text-panas-dark/60 mt-1">Kelola informasi pribadi dan keamanan akun Anda.</p>
        </div>

        <div class="space-y-6">
            <!-- Update Profile Card -->
            <div class="p-6 sm:p-8 bg-white shadow-panas-card border border-panas-border rounded-3xl">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <!-- Update Password Card -->
            <div class="p-6 sm:p-8 bg-white shadow-panas-card border border-panas-border rounded-3xl">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <!-- Delete User Card -->
            <div class="p-6 sm:p-8 bg-white shadow-panas-card border border-panas-border rounded-3xl">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>

@endsection
