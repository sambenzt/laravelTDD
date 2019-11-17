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

        $response = $this->post('authors',$this->data());
            
        $author = Author::first();

        $this->assertEquals(1,$author->id);

        $this->isInstanceOf(Carbon::class,$author->dob);

        $this->assertEquals('28/04/1998',$author->dob);
    }

    /** @test */
    public function a_name_is_required()
    {   
        $response = $this->post('/authors',array_merge($this->data(),['name' => '']));

        $response->assertSessionHasErrors('name');
    }

    /** @test */
    public function a_dob_is_required()
    {   
        $response = $this->post('/authors',array_merge($this->data(),['dob' => '']));

        $response->assertSessionHasErrors('dob');
    }

    private function data()
    {
        return [
            'name' => 'Author name',
            'dob'  => '28/04/1998'
        ];
    }
}
