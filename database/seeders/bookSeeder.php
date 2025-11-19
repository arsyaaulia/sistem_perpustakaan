<?php
namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    public function run()
    {
        
        Book::truncate();

        $books = [
            [
                'title' => 'Pemrograman Laravel untuk Pemula',
                'author' => 'John Doe',
                'isbn' => '978-1234567890',
                'published_year' => 2023,
                'quantity' => 5,
                'category' => 'Teknologi',
                'description' => 'Buku panduan lengkap belajar Laravel dari dasar'
            ],
            [
                'title' => 'Seni Berpikir Kreatif', 
                'author' => 'Jane Smith',
                'isbn' => '978-0987654321',
                'published_year' => 2022,
                'quantity' => 3,
                'category' => 'Psikologi',
                'description' => 'Mengembangkan kemampuan berpikir kreatif dalam kehidupan sehari-hari'
            ],
            [
                'title' => 'Sejarah Indonesia Modern',
                'author' => 'Prof. Ahmad Mansur',
                'isbn' => '978-1122334455', 
                'published_year' => 2021,
                'quantity' => 4,
                'category' => 'Sejarah',
                'description' => 'Tinjauan sejarah Indonesia dari masa kemerdekaan hingga sekarang'
            ],
            [
                'title' => 'Kiat Sukses Berwirausaha',
                'author' => 'Maria Magdalena',
                'isbn' => '978-5566778899',
                'published_year' => 2023,
                'quantity' => 6,
                'category' => 'Bisnis',
                'description' => 'Panduan praktis memulai dan mengembangkan bisnis'
            ],
            [
                'title' => 'Filsafat untuk Kehidupan Sehari-hari',
                'author' => 'Dr. Robert Johnson', 
                'isbn' => '978-6677889900',
                'published_year' => 2020,
                'quantity' => 2,
                'category' => 'Filsafat',
                'description' => 'Menerapkan prinsip filsafat dalam menyelesaikan masalah kehidupan'
            ],
            [
                'title' => 'Data Science dengan Python',
                'author' => 'Michael Chen',
                'isbn' => '978-7788990011',
                'published_year' => 2023,
                'quantity' => 4,
                'category' => 'Teknologi',
                'description' => 'Belajar analisis data dan machine learning menggunakan Python'
            ],
            [
                'title' => 'Seni Memasak Modern',
                'author' => 'Chef Andi',
                'isbn' => '978-8899001122',
                'published_year' => 2022,
                'quantity' => 3,
                'category' => 'Kuliner',
                'description' => 'Resep-resep masakan modern untuk pemula hingga advanced'
            ]
        ];

        foreach ($books as $book) {
            Book::create($book);
        }

        // Tambahan buku dummy
        Book::factory(8)->create();
    }
}