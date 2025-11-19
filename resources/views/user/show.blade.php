<!-- resources/views/users/show.blade.php -->
@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h4>Profil Anggota</h4>
            </div>
            <div class="card-body text-center">
                <div class="mb-3">
                    <i class="fas fa-user-circle fa-5x text-primary"></i>
                </div>
                <h5>{{ $user->name }}</h5>
                <p class="text-muted">{{ $user->email }}</p>
                <span class="badge @if($user->role == 'admin') bg-danger @else bg-primary @endif fs-6">
                    {{ $user->role }}
                </span>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5>Riwayat Peminjaman</h5>
            </div>
            <div class="card-body">
                @if($user->borrows->count() > 0)
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Buku</th>
                                <th>Tanggal Pinjam</th>
                                <th>Batas Kembali</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($user->borrows as $borrow)
                            <tr>
                                <td>{{ $borrow->book->title }}</td>
                                <td>{{ $borrow->borrow_date->format('d M Y') }}</td>
                                <td>{{ $borrow->return_date->format('d M Y') }}</td>
                                <td>
                                    <span class="badge @if($borrow->status == 'borrowed') bg-warning 
                                                    @elseif($borrow->status == 'returned') bg-success 
                                                    @else bg-danger @endif">
                                        {{ $borrow->status }}
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <p class="text-muted">Belum ada riwayat peminjaman</p>
                @endif
            </div>
        </div>
    </div>
</div>

<a href="{{ route('users.index') }}" class="btn btn-secondary mt-3">
    <i class="fas fa-arrow-left"></i> Kembali ke Daftar Anggota
</a>
@endsection