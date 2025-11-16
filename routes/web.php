<?php
// routes/web.php
use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Routes untuk Books
Route::get('/books', [BookController::class, 'index'])->name('books.index');
Route::get('/books/{id}', [BookController::class, 'show'])->name('books.show');

// Routes untuk Borrow
Route::get('/borrows', [BorrowController::class, 'index'])->name('borrows.index');
Route::post('/borrows', [BorrowController::class, 'store'])->name('borrows.store');
Route::put('/borrows/{id}/return', [BorrowController::class, 'returnBook'])->name('borrows.return');

// Routes untuk Users
Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');