@extends('layouts.site')

@section('title', 'Edit Lowongan - Admin Info Loker Panas')

@section('content')

    <div class="max-w-4xl mx-auto px-4 sm:px-6 py-8">
        <!-- Breadcrumb & Header -->
        <div class="mb-6">
            <div class="flex items-center gap-2 text-xs font-medium text-panas-dark/50 mb-2">
                <a href="{{ route('admin.dashboard') }}" class="hover:text-panas-ember transition-colors">Dashboard Admin</a>
                <span>/</span>
                <a href="{{ route('admin.lowongan.index') }}" class="hover:text-panas-ember transition-colors">Lowongan Kerja</a>
                <span>/</span>
                <span class="text-panas-dark font-semibold">Edit Lowongan</span>
            </div>
            <h1 class="font-display text-2xl sm:text-3xl font-extrabold text-panas-dark">Edit Lowongan Kerja</h1>
            <p class="text-sm text-panas-dark/60 mt-1">Perbarui informasi postingan lowongan kerja di bawah ini.</p>
        </div>

        <form action="{{ route('admin.lowongan.update', $lowongan->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('admin.lowongan._form')
        </form>
    </div>

@endsection