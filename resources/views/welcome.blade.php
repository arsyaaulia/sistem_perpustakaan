<!-- resources/views/welcome.blade.php -->
@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12 text-center">
        <h1 class="display-4 mb-4">Selamat Datang di Perpustakaan Digital</h1>
        <p class="lead">Temukan buku-buku menarik dan kelola peminjaman dengan mudah</p>
        
        <div class="row mt-5">
            <div class="col-md-4 mb-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-body text-center">
                        <i class="fas fa-book fa-3x text-primary mb-3"></i>
                        <h3>{{ \App\Models\Book::count() }} Buku</h3>
                        <p class="text-muted">Koleksi buku tersedia</p>
                        <a href="{{ route('books.index') }}" class="btn btn-primary">Lihat Buku</a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4 mb-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-body text-center">
                        <i class="fas fa-users fa-3x text-success mb-3"></i>
                        <h3>{{ \App\Models\User::where('role', 'member')->count() }} Anggota</h3>
                        <p class="text-muted">Anggota terdaftar</p>
                        <a href="{{ route('users.index') }}" class="btn btn-success">Lihat Anggota</a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4 mb-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-body text-center">
                        <i class="fas fa-exchange-alt fa-3x text-warning mb-3"></i>
                        <h3>{{ \App\Models\Borrow::where('status', 'borrowed')->count() }} Dipinjam</h3>
                        <p class="text-muted">Buku sedang dipinjam</p>
                        <a href="{{ route('borrows.index') }}" class="btn btn-warning">Lihat Peminjaman</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection