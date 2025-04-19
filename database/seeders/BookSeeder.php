<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Book;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Book::insert([
            ['title' => '1984', 'author' => 'George Orwell'],
            ['title' => 'To Kill a Mockingbird', 'author' => 'Harper Lee'],
            ['title' => 'The Great Gatsby', 'author' => 'F. Scott Fitzgerald'],
        ]);
    }
}
