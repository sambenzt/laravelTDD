<?php

namespace App\Http\Controllers;

use App\Author;
use Illuminate\Http\Request;

class AuthorsController extends Controller
{
    public function store(Request $request)
    {
        Author::create($this->validateRequest($request));
    }

    private function validateRequest($request)
    {
        return $request->validate([
            'name' => 'required',
            'dob'  => 'required'
        ]);
    }
}
