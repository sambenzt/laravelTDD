<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    public function store(Request $request)
    {
        $book = Book::create($this->validateRequest($request));

        return redirect($book->path());
    }

    public function update(Request $request,Book $book)         
    {
        $book->update($this->validateRequest($request));

        return redirect($book->path());
    }

    protected function validateRequest($request)
    {
        return $request->validate([
            'title'  => 'required',
            'author' => 'required'
        ]);
    }

    public function destroy(Book $book)
    {
        $book->delete();

        return redirect('/books');
    }
}
