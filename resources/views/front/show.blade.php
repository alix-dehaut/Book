@extends('layouts.master')

@section('content')
<article class="row">
    <div class="col-md-12">
    @if(count($book)>0)
    <h1>{{$book->title}}</h1>
    @if(count($book->picture) > 0)
        <div class="col-xs-6 col-md-12">
            <a href="#" class="thumbnail">
            <img src="{{asset('images/'.$book->picture->link)}}" alt="{{$book->picture->title}}">
            </a>
        </div>
    @endif
    <h2>Description :</h2>
    {{$book->description}}    
    <h3>Auteur(s) :</h3>
    <ul>
        @forelse($book->authors as $author)
        <li>{{$author->name}}</a></li>
        @empty
        <li>Aucun auteur</li>
        @endforelse
    </ul>
    @else 
    <h1>Désolé aucun article</h1>
    @endif 
    <h3>Note du livre : {{$book->avgScore()}}</h3>
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <form method="post" action="{{route('vote')}}">
            {{ csrf_field() }}
            <input type="hidden" name="book_id" value="{{$book->id}}">
            <input type="hidden" name="IP" value="{{request()->ip()}}">            
            <select name="vote" >
                @for ($i = 1; $i < 6; $i++)
                <option value="{{$i}}">{{$i}}</option>
                @endfor
            </select>
            <input class="btn btn-primary" type="submit" value="OK">
        </form>
        @if(Session::has('message'))
        <div class="alert">
            <p>{{Session::get('message')}}</p>
        </div>
        @endif
</article>

@endsection 