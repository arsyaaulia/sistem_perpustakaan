<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Books extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'author', 'isbn', 'published_year', 
        'quantity', 'category', 'description'
    ];

    // Relasi one-to-many dengan borrows
    public function borrows()
    {
        return $this->hasMany(Borrow::class);
    }

    // Relasi many-to-many dengan users melalui borrows
    public function users()
    {
        return $this->belongsToMany(User::class, 'borrows')
                    ->withPivot('borrow_date', 'return_date', 'status')
                    ->withTimestamps();
    }

    // Accessor untuk status ketersediaan
    public function getAvailableAttribute()
    {
        $borrowedCount = $this->borrows()->where('status', 'borrowed')->count();
        return $this->quantity - $borrowedCount;
    }
}