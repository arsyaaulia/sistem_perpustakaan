<?php
// app/Http/Controllers/BookController.php
namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::with('borrows')
                    ->orderBy('title')
                    ->paginate(10);
        
        return view('books.index', compact('books'));
    }

    public function show($id)
    {
        $book = Book::with(['borrows.user'])->findOrFail($id);
        $available = $book->available;
        
        return view('books.show', compact('book', 'available'));
    }
}