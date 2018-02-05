<?php

use Illuminate\Database\Seeder;

use Faker\Generator as Faker; // alias de nom de classe utiliser à la ligne 18

class BookTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    private $faker;
  
  // injection de dépendance 
    public function __construct(Faker $faker){
    
        $this->faker = $faker; // Laravel qui injectera le composant Faker directement 
    
  }

    public function run()
    {
    	Storage::disk('local')->delete(Storage::allFiles());

    	App\Genre::create([
    		'name'=> 'science'
    	]);
    	App\Genre::create([
    		'name'=> 'maths'
    	]);
    	App\Genre::create([
    		'name'=> 'cookbook'
    	]);

        factory(App\Book::class, 30)->create()->each(function($book){
        	$genre= App\Genre::find(rand(1,3));

        	$book->genre()->associate($genre);
        	$book->save();

        	$link= str_random(12).'.jpg';
        	$file= file_get_contents('http://lorempicsum.com/futurama/250/250/'. rand(1,9));
        	Storage::disk('local')->put($link, $file);

        	$book->picture()->create([
        		'title'=>'Default',
        		'link'=>$link
        	]);

        	$authors= App\Author::pluck('id')->shuffle()->slice(0, rand(1,3))->all();

        	$book->authors()->attach($authors);
        });


    }
}
