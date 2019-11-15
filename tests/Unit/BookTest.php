<?php

namespace Tests\Unit;

use App\Book;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookTest extends TestCase
{

   use RefreshDatabase;
        
   /** @test */ 
   public function an_author_is_created_when_book_is_created()
   {
        Book::create([
            'title'     => 'Sam',
            'author_id' => 'Juan Perez'
        ]);

        $this->assertCount(1,Book::all());
   }

}
