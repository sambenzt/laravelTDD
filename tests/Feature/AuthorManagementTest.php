<?php

namespace Tests\Feature;

use App\Author;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthorManagementTest extends TestCase
{
    use RefreshDatabase;
    /** @test */ 
    public function an_author_can_be_created()
    {
        $this->withoutExceptionHandling();

        $response = $this->post('authors',[
            'name' => 'Author name',
            'dob'  => '28/04/1998'
        ]);
            
        $author = Author::first();

        $this->assertEquals(1,$author->id);

        $this->isInstanceOf(Carbon::class,$author->dob);

        $this->assertEquals('28/04/1998',$author->dob);
    }
}
