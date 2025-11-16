<!-- resources/views/books/index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="fas fa-book"></i> Daftar Buku</h2>
    <span class="badge bg-primary">Total: {{ $books->total() }} buku</span>
</div>

<div class="row">
    @foreach($books as $book)
    <div class="col-md-6 col-lg-4 mb-4">
        <div class="card book-card h-100 shadow-sm">
            <div class="card-body">
                <h5 class="card-title">{{ $book->title }}</h5>
                <p class="card-text">
                    <strong>Penulis:</strong> {{ $book->author }}<br>
                    <strong>Kategori:</strong> {{ $book->category }}<br>
                    <strong>Tahun:</strong> {{ $book->published_year }}<br>
                    <strong>ISBN:</strong> {{ $book->isbn }}
                </p>
                <div class="d-flex justify-content-between align-items-center">
                    <span class="badge @if($book->available > 0) bg-success @else bg-danger @endif">
                        Tersedia: {{ $book->available }}/{{ $book->quantity }}
                    </span>
                    <a href="{{ route('books.show', $book->id) }}" class="btn btn-sm btn-outline-primary">
                        Detail
                    </a>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

<div class="d-flex justify-content-center">
    {{ $books->links() }}
</div>
@endsection