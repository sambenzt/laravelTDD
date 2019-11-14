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

        $book = Book::first();

        $this->assertDatabaseHas('books',[  
            'title'  => 'Cool Book',
            'author' => 'Sam Benzt'
        ]);

        $response->assertRedirect($book->path());
    }

    /** @test */ 
    public function a_title_is_required()
    {

        $response = $this->post('/books',[  
            'title'  => '',
            'author' => 'Sam Benzt'
        ]);

        $response->assertSessionHasErrors('title');

        $this->assertCount(0,Book::all());
    }
    
    /** @test */ 
    public function a_author_is_required()
    {

        $response = $this->post('/books',[  
            'title'  => 'Cool Book Sam',
            'author' => ''
        ]);

        $response->assertSessionHasErrors('author');

        $this->assertCount(0,Book::all());
    }
    
    /** @test */ 
    public function a_book_can_be_updated()
    {
        $this->post('/books',[  
            'title'  => 'Title',
            'author' => 'Sam Benzt'
        ]);

        $book = Book::first();

        $response = $this->put($book->path(),[  
            'title'  => 'New Title',
            'author' => 'New Author'
        ]);

        $book->refresh();

        $this->assertEquals('New Title',$book->title);

        $this->assertEquals('New Author',$book->author);

        $response->assertRedirect($book->path());
    }

    /** @test */ 
    public function a_book_can_be_deleted()
    {

        $this->post('/books',[  
            'title'  => 'Title',
            'author' => 'Sam Benzt'
        ]);

        $book = Book::first();

        $response = $this->delete($book->path());

        $this->assertCount(0,Book::all());

        $response->assertRedirect('/books');
    }
}
