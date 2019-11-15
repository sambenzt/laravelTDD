<?php

namespace Tests\Unit;

use App\Author;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthorTest extends TestCase
{

    use RefreshDatabase;

    /** @test */ 
    public function only_name_is_required_to_create_an_author()     
    {
        $author = Author::create(['name' => 'Sam Benzt']);

        $this->assertCount(1,Author::all());

        $this->assertEquals('Sam Benzt', $author->name);
    }

    /** @test */ 
}
