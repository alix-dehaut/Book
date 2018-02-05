<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable=[
        'title', 'description', 'genre_id', 'status'
    ];

    public function setGenreIdAttribute($value){
        if($value ==0){
            $this->attributes['genre_id']= null;
        }else{
            $this->attributes['genre_id']= $value;
        }
    }

    public function scopePublished($query){
        return $query->where('status', 'published');
    }
    
    public function genre(){
    	return $this->belongsTo(Genre::class);
    }

    public function authors(){
    	return $this->belongsToMany(Author::class);
    }

    public function picture(){
    	return $this->hasOne(Picture::class);
    }

    public function scores(){
    	return $this->hasMany(Score::class);
    }

    public function avgScore(){
    	return $this->scores()->avg('vote');
    }
}
