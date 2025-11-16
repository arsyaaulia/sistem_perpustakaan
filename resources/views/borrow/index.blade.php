@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="fas fa-exchange-alt"></i> Data Peminjaman</h2>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Anggota</th>
                        <th>Buku</th>
                        <th>Tanggal Pinjam</th>
                        <th>Batas Kembali</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($borrows as $borrow)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $borrow->user->name }}</td>
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
                        <td>
                            @if($borrow->status == 'borrowed')
                            <form action="{{ route('borrows.return', $borrow->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-sm btn-success">
                                    <i class="fas fa-check"></i> Kembalikan
                                </button>
                            </form>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <div class="d-flex justify-content-center">
            {{ $borrows->links() }}
        </div>
    </div>
</div>
@endsection