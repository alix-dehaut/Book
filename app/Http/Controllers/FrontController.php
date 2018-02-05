<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use App\Author;
use App\Genre;
use App\Score;

class FrontController extends Controller
{

	public function __construct(){
    	view()->composer('partials.menu', function($view){
    		$genres=Genre::pluck('name', 'id')->all();
    		$view->with('genres', $genres);
    	});
    }

    public function index(){
    	$books =  Book::published()->with('picture', 'authors')->paginate(5);
    	return view('front.index', ["books" => $books]);
    }

    public function show(int $id){
    	$book= Book::find($id);
    	return view('front.show',["book"=>$book]);
    }

     public function showBookByAuthor(int $id){
    	$books = Author::find($id)->books()->paginate(5);
    	return view('front.author',["books" => $books]);
    }

    public function showBookByGenre(int $id){
    	$books = Genre::find($id)->books()->paginate(5);
    	return view('front.genre',["books" => $books]);
    }

    public function create(Request $request){
    	// si une condition renvoie false => redirection vers le formulaire back()
    	$this->validate($request, [
    		'book_id'=>"integer|required|uniqueVoteIp:{$request->IP}",
    		'IP'=>'ipv4|required',
    		'vote'=>'in:1,2,3,4,5',	
    	]);

    	/*$this->message($request){
    		return [
        	'book_id.uniqueVoteIp' => 'A title is required',
    		];
		}*/
    	//dump($request->all);
    	$score=Score::create($request->all()); //assignation de masse
    	//dump($score);
    	//dump($score->id);
    	return back()->with('message', 'Merci pour votre vote'); // Session::get('message')
    }

    	/*
    	public function showAvgScoreBook(int $id){
    	$books = Book::find($id);
    	$
    	return view('front.genre',["books" => $books]);
    }
    */
    
}
