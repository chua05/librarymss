<?php

namespace App\Http\Controllers\Attendant;

use App\Http\Controllers\Controller;
use App\Models\Book;

class BookController extends Controller
{
    public function available()
    {
        $books = Book::latest()->get();

        return view('attendant.books.available', compact('books'));
    }
}
