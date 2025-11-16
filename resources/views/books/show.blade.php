<!-- resources/views/books/show.blade.php -->
@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4>{{ $book->title }}</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Penulis:</strong> {{ $book->author }}</p>
                        <p><strong>Kategori:</strong> {{ $book->category }}</p>
                        <p><strong>Tahun Terbit:</strong> {{ $book->published_year }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>ISBN:</strong> {{ $book->isbn }}</p>
                        <p><strong>Stok Total:</strong> {{ $book->quantity }}</p>
                        <p>
                            <strong>Status:</strong> 
                            <span class="badge @if($available > 0) bg-success @else bg-danger @endif">
                                @if($available > 0) Tersedia @else Tidak Tersedia @endif
                            </span>
                        </p>
                    </div>
                </div>
                
                @if($book->description)
                <div class="mt-3">
                    <h5>Deskripsi</h5>
                    <p>{{ $book->description }}</p>
                </div>
                @endif
            </div>
        </div>

        <!-- Form Peminjaman -->
        <div class="card mt-4">
            <div class="card-header">
                <h5>Pinjam Buku Ini</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('borrows.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="book_id" value="{{ $book->id }}">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="user_id" class="form-label">Pilih Anggota</label>
                                <select class="form-select" id="user_id" name="user_id" required>
                                    <option value="">-- Pilih Anggota --</option>
                                    @foreach(\App\Models\User::where('role', 'member')->get() as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Status Ketersediaan</label>
                                <div>
                                    <span class="badge @if($available > 0) bg-success @else bg-danger @endif fs-6">
                                        {{ $available }} buku tersedia
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary" @if($available <= 0) disabled @endif>
                        <i class="fas fa-hand-holding"></i> Pinjam Buku
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5>Riwayat Peminjaman</h5>
            </div>
            <div class="card-body">
                @if($book->borrows->count() > 0)
                    @foreach($book->borrows->take(5) as $borrow)
                    <div class="d-flex justify-content-between align-items-center mb-2 p-2 rounded @if($borrow->status == 'borrowed') status-borrowed @else status-returned @endif">
                        <div>
                            <small class="fw-bold">{{ $borrow->user->name }}</small><br>
                            <small>{{ $borrow->borrow_date->format('d M Y') }}</small>
                        </div>
                        <span class="badge @if($borrow->status == 'borrowed') bg-warning @else bg-success @endif">
                            {{ $borrow->status }}
                        </span>
                    </div>
                    @endforeach
                @else
                    <p class="text-muted">Belum ada riwayat peminjaman</p>
                @endif
            </div>
        </div>
    </div>
</div>

<a href="{{ route('books.index') }}" class="btn btn-secondary mt-3">
    <i class="fas fa-arrow-left"></i> Kembali ke Daftar Buku
</a>
@endsection