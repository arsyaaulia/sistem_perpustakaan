<?php
// app/Models/User.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'role'];

    // Relasi one-to-many dengan borrows
    public function borrows()
    {
        return $this->hasMany(Borrow::class);
    }

    // Relasi many-to-many dengan books melalui borrows
    public function books()
    {
        return $this->belongsToMany(Book::class, 'borrows')
                    ->withPivot('borrow_date', 'return_date', 'status')
                    ->withTimestamps();
    }
}