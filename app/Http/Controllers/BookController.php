<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Genre;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function getAllBooks(): JsonResponse{
        $genres = Genre::all();
        $books = Book::with('genres')->paginate(10);

        return response()->json([
            'books' => $books,
            'genres' => $genres
        ]);
    }
}
