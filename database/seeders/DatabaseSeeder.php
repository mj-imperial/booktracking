<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Genre;
use App\Models\User;
use Arr;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $sampleGenres = ['Fantasy', 'Science', 'Fiction', 'Mystery',
                'Thriller', 'Romance', 'Historical Fiction', 'Non-Fiction',
                'Biography', 'Self-Help'];

        $genreIds = collect($sampleGenres)->map(function($genre) {
            return Genre::factory()->create(['name' => $genre])->id;
        });

        $users = User::factory(10)->create();

        Book::factory(10)->create()->each(function($book) use ($genreIds, $users){
            $book->genres()->attach(
                Arr::random($genreIds->toArray(), rand(1,3))
            );
            $book->users()->attach(
                $users->random(rand(1,3))->pluck('id')
            );
        });
    }
}
