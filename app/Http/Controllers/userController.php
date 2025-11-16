<?php
// app/Http/Controllers/UserController.php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::withCount(['borrows as active_borrows_count' => function($query) {
                        $query->where('status', 'borrowed');
                    }])
                    ->orderBy('name')
                    ->paginate(10);
        
        return view('users.index', compact('users'));
    }

    public function show($id)
    {
        $user = User::with(['borrows.book' => function($query) {
                        $query->orderBy('borrow_date', 'desc');
                    }])
                    ->findOrFail($id);
        
        return view('users.show', compact('user'));
    }
}