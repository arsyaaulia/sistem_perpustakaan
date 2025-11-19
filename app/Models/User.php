<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name', 
        'email', 
        'password', 
        'role'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

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