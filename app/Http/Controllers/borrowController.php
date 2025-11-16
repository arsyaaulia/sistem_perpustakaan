<?php
// app/Http/Controllers/BorrowController.php
namespace App\Http\Controllers;

use App\Models\Borrow;
use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BorrowController extends Controller
{
    public function index()
    {
        $borrows = Borrow::with(['user', 'book'])
                        ->orderBy('created_at', 'desc')
                        ->paginate(10);
        
        return view('borrows.index', compact('borrows'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'book_id' => 'required|exists:books,id',
        ]);

        $book = Book::find($request->book_id);
        
        // Cek ketersediaan buku
        if ($book->available <= 0) {
            return redirect()->back()->with('error', 'Buku tidak tersedia untuk dipinjam');
        }

        // Cek apakah user sudah meminjam buku yang sama
        $existingBorrow = Borrow::where('user_id', $request->user_id)
                                ->where('book_id', $request->book_id)
                                ->where('status', 'borrowed')
                                ->exists();
        
        if ($existingBorrow) {
            return redirect()->back()->with('error', 'Anda sudah meminjam buku ini');
        }

        Borrow::create([
            'user_id' => $request->user_id,
            'book_id' => $request->book_id,
            'borrow_date' => Carbon::now(),
            'return_date' => Carbon::now()->addDays(14),
            'status' => 'borrowed',
        ]);

        return redirect()->route('borrows.index')->with('success', 'Buku berhasil dipinjam');
    }

    public function returnBook($id)
    {
        $borrow = Borrow::findOrFail($id);
        
        $borrow->update([
            'actual_return_date' => Carbon::now(),
            'status' => 'returned',
        ]);

        return redirect()->back()->with('success', 'Buku berhasil dikembalikan');
    }
}