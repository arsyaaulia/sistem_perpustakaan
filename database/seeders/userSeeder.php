<?php
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::truncate();

        // Buat admin
        User::create([
            'name' => 'Admin Perpustakaan',
            'email' => 'admin@perpustakaan.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);

        // Buat member
        $members = [
            [
                'name' => 'Budi Santoso',
                'email' => 'budi@email.com',
                'password' => Hash::make('password123'),
                'role' => 'member',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Siti Rahayu',
                'email' => 'siti@email.com', 
                'password' => Hash::make('password123'),
                'role' => 'member',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Ahmad Fauzi',
                'email' => 'ahmad@email.com',
                'password' => Hash::make('password123'),
                'role' => 'member',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Maya Sari',
                'email' => 'maya@email.com',
                'password' => Hash::make('password123'),
                'role' => 'member',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Rizki Pratama',
                'email' => 'rizki@email.com',
                'password' => Hash::make('password123'),
                'role' => 'member',
                'email_verified_at' => now(),
            ]
        ];

        foreach ($members as $member) {
            User::create($member);
        }

        // Jika ingin tambahan dummy, gunakan factory dengan email unik
        User::factory(5)->create([
            'role' => 'member',
            'password' => Hash::make('password123')
        ]);
    }
}