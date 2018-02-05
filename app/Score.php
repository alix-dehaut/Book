<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    public function book(){
    	return $this->belongsTo(Book::class);
    }

    protected $fillable=[
    	'IP', 'book_id', 'vote'
    ];

}
