<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Book;

class BookControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */ 
    public function a_book_can_be_added_to_the_library()
    {

        $response = $this->post('/books',[  
            'title'  => 'Cool Book',
            'author' => 'Sam Benzt'
        ]);

        $response->assertStatus(200);

        $this->assertDatabaseHas('books',[  
            'title'  => 'Cool Book',
            'author' => 'Sam Benzt'
        ]);
    }

    /** @test */ 
    public function a_title_is_required()
    {

        //$this->withoutExceptionHandling();

        $response = $this->post('/books',[  
            'title'  => '',
            'author' => 'Sam Benzt'
        ]);

        $response->assertSessionHasErrors('title');

        //$this->assertCount(0,Book::count());
    }
    
    /** @test */ 
    public function a_author_is_required()
    {

        //$this->withoutExceptionHandling();

        $response = $this->post('/books',[  
            'title'  => 'Cool Book Sam',
            'author' => ''
        ]);

        $response->assertSessionHasErrors('author');

        //$this->assertCount(0,Book::count());
    }
    
    /** @test */ 
    public function a_book_can_be_updated()
    {

        $this->withoutExceptionHandling();

        $this->post('/books',[  
            'title'  => 'Title',
            'author' => 'Sam Benzt'
        ]);

        $book = Book::first();

        $response = $this->put('books/' . $book->id,[  
            'title'  => 'New Title',
            'author' => 'New Author'
        ]);

        $response->assertStatus(200);

        $this->assertEquals('New Title',Book::first()->title);
        $this->assertEquals('New Author',Book::first()->author);
    }
}
