<?php
// database/factories/BookFactory.php
namespace Database\Factories;

use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    protected $model = Book::class;

    public function definition(): array
    {
        $categories = ['Teknologi', 'Fiksi', 'Non-Fiksi', 'Bisnis', 'Sejarah', 'Sains', 'Seni', 'Psikologi', 'Kuliner'];
        
        return [
            'title' => $this->faker->sentence(4),
            'author' => $this->faker->name(),
            'isbn' => $this->faker->isbn13(),
            'published_year' => $this->faker->numberBetween(2000, 2023),
            'quantity' => $this->faker->numberBetween(1, 10),
            'category' => $this->faker->randomElement($categories),
            'description' => $this->faker->paragraph(3),
        ];
    }
}