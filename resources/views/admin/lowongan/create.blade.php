@extends('layouts.admin')

@section('title', 'Tambah Lowongan - Admin Info Loker Panas')
@section('page-title', 'Buat Postingan Lowongan Baru')
@section('page-subtitle', 'Lengkapi informasi lowongan kerja di bawah ini untuk dipublikasikan')

@section('content')

    <form action="{{ route('admin.lowongan.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('admin.lowongan._form')
    </form>

@endsection