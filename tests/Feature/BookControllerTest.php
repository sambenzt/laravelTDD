<?php

namespace Tests\Feature;

use App\Author;
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
        $response = $this->post('/books',$this->data());

        $book = Book::first();

        $this->assertDatabaseHas('books',$this->data());

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
    public function a_author_id_is_required()
    {
        $response = $this->post('/books',array_merge($this->data(),['author_id' => '']));

        $response->assertSessionHasErrors('author_id');

        $this->assertCount(0,Book::all());
    }
    
    /** @test */ 
    public function a_book_can_be_updated()
    {
        $this->withoutExceptionHandling();

        $this->post('/books',$this->data());

        $book = Book::first();

        $response = $this->put($book->path(),[  
            'title'     => 'New Title',
            'author_id' => 'New Author'
        ]);

        $book->refresh();

        $this->assertEquals('New Title',$book->title);

        $this->assertEquals(2,$book->author_id);

        $response->assertRedirect($book->path());
    }

    /** @test */ 
    public function a_book_can_be_deleted()
    {

        $this->post('/books',$this->data());

        $book = Book::first();

        $response = $this->delete($book->path());

        $this->assertCount(0,Book::all());

        $response->assertRedirect('/books');
    }

    /** @test */ 
    public function a_new_author_is_automaticlly_added()
    {
        $this->withoutExceptionHandling();

        $this->post('/books',[  
            'title'     => 'Title',
            'author_id' => 'Sam Benzt'
        ]);

        $book   = Book::first();
        $author = Author::first(); 

        $this->assertEquals($author->id,$book->author_id);
        $this->assertCount(1,Author::all());

    }

    private function data()
    {
        return [
            'title'     => 'An Amazing Title',
            'author_id' => '1'
        ];
    }
}
