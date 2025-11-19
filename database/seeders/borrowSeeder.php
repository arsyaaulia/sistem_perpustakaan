<?php
// database/seeders/BorrowSeeder.php
namespace Database\Seeders;

use App\Models\Borrow;
use App\Models\User;
use App\Models\Book;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class BorrowSeeder extends Seeder
{
    public function run()
    {
        // Hapus data existing
        Borrow::truncate();

        $users = User::where('role', 'member')->get();
        $books = Book::all();

        foreach ($users as $user) {
            // Setiap user meminjam 1-3 buku
            $borrowCount = rand(1, 3);
            $borrowedBooks = $books->random($borrowCount);
            
            foreach ($borrowedBooks as $book) {
                $borrowDate = Carbon::now()->subDays(rand(1, 60));
                $returnDate = $borrowDate->copy()->addDays(14);
                
                // 70% sudah dikembalikan, 30% masih dipinjam
                $status = rand(1, 10) <= 7 ? 'returned' : 'borrowed';
                $actualReturnDate = $status === 'returned' ? 
                    $returnDate->copy()->addDays(rand(-2, 5)) : null;

                // Cek apakah sudah ada peminjaman yang sama
                $existingBorrow = Borrow::where('user_id', $user->id)
                                        ->where('book_id', $book->id)
                                        ->where('status', 'borrowed')
                                        ->exists();
                
                if (!$existingBorrow) {
                    Borrow::create([
                        'user_id' => $user->id,
                        'book_id' => $book->id,
                        'borrow_date' => $borrowDate,
                        'return_date' => $returnDate,
                        'actual_return_date' => $actualReturnDate,
                        'status' => $status,
                    ]);
                }
            }
        }
    }
}