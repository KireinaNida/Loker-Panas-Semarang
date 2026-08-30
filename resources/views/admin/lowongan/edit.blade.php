@extends('layouts.admin')

@section('title', 'Edit Lowongan - Admin Info Loker Panas')
@section('page-title', 'Edit Lowongan Kerja')
@section('page-subtitle', 'Perbarui informasi postingan lowongan kerja di bawah ini.')

@section('content')

    <div class="max-w-6xl mx-auto">

        <!-- Breadcrumb -->
        <div class="flex items-center gap-2 text-xs font-medium text-slate-500 mb-6">
            <a href="{{ route('admin.dashboard') }}" class="hover:text-orange-500 transition-colors">Dashboard Admin</a>
            <span>/</span>
            <a href="{{ route('admin.lowongan.index') }}" class="hover:text-orange-500 transition-colors">Lowongan Kerja</a>
            <span>/</span>
            <span class="text-slate-800 font-semibold">Edit Lowongan</span>
        </div>

        <form action="{{ route('admin.lowongan.update', $lowongan->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('admin.lowongan._form')
        </form>

    </div>

@endsection