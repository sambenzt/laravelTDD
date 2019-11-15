<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Author; 

class Book extends Model
{
    protected $guarded = ['id'];

    public function path()
    {
        return "/books/{$this->id}";
    }

    public function setAuthorIdAttribute($author)
    {
        $this->attributes['author_id'] = Author::firstOrCreate([
            'name' => $author
        ])->id;
    }

}
