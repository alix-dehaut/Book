@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h1>Create Book :  </h1>
                <form action="{{route('book.store')}}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form">
                        <div class="form-group">
                            <label for="title">Titre :</label>
                            <input type="text" name="title" value="{{old('title')}}" class="form-control" id="title"
                                   placeholder="Titre du livre">
                                   @if($errors->has('title')) <span class="error">{{$errors->first('title')}}</span>@endif
                        </div>
                        <div class="form-group">
                            <label for="price">Description :</label>
                            <textarea type="text" name="description" class="form-control">{{old('description')}}</textarea>
                            @if($errors->has('description')) <span class="error">{{$errors->first('description')}}</span>@endif
                        </div>
                    </div>

                    <div class="form-select">
                    <label for="genre">Genre :</label>
                    <select id="genre" name="genre_id">
                        <option value="0" {{ is_null(old('genre_id'))? 'selected' : '' }} >No genre</option>
                        @foreach($genres as $id => $name)
                            <option {{ old('genre_id')==$id? 'selected' : '' }} value="{{$id}}">{{$name}}</option>
                        @endforeach
                    </select>
                    
                    </div>

                    <h1>Choisissez un/des auteurs</h1>
                    <div class="form-inline">
                        <div class="form-group">
                    @forelse($authors as $id => $name)
                        <label class="control-label" for="author{{$id}}">{{$name}}</label>
                        <input name="authors[{{$id}}]" value="{{$id}}" type="checkbox" class="form-control" id="author{{$id}}" @if(array_key_exists($id, old('authors', []))) checked @endif>
                        @if($errors->has('authors')) <span class="error">{{$errors->first('authors')}}</span>@endif
                    @empty
                    @endforelse
                        </div>
                    </div>
            </div><!-- #end col md 6 -->
            <div class="col-md-6">
                <button type="submit" class="btn btn-primary">Ajouter un livre</button>
                <div class="input-radio">
            <h2>Status</h2>
            <input type="radio" @if(old('status')=='published') checked @endif name="status" value="published" > publier<br>
            <input type="radio" @if(old('status')=='unpublished') checked @endif name="status" value="unpublished" checked> dépulier<br>
            </div>
            <div class="input-file">
                <h2>File :</h2>
                <label for="genre">Title image :</label>
                <input type="text" name="title_image" value="{{old('title_image')}}">
                <input class="file" type="file" name="picture" >
                @if($errors->has('picture')) <span class="error bg-warning text-warning">{{$errors->first('picture')}}</span> @endif
            </div>
            </div><!-- #end col md 6 -->
            </form>
        </div>
@endsection
