<!-- resources/views/users/index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="fas fa-users"></i> Daftar Anggota</h2>
    <span class="badge bg-primary">Total: {{ $users->total() }} anggota</span>
</div>

<div class="row">
    @foreach($users as $user)
    <div class="col-md-6 col-lg-4 mb-4">
        <div class="card h-100 shadow-sm">
            <div class="card-body">
                <h5 class="card-title">{{ $user->name }}</h5>
                <p class="card-text">
                    <i class="fas fa-envelope"></i> {{ $user->email }}<br>
                    <i class="fas fa-user-tag"></i> 
                    <span class="badge @if($user->role == 'admin') bg-danger @else bg-primary @endif">
                        {{ $user->role }}
                    </span>
                </p>
                <div class="d-flex justify-content-between align-items-center">
                    <span class="badge bg-warning text-dark">
                        <i class="fas fa-book"></i> {{ $user->active_borrows_count }} buku dipinjam
                    </span>
                    <a href="{{ route('users.show', $user->id) }}" class="btn btn-sm btn-outline-primary">
                        Detail
                    </a>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

<div class="d-flex justify-content-center">
    {{ $users->links() }}
</div>
@endsection