
@extends('layouts.app')

@section('content')
    <div>

        <h1 align="center"> hello world </h1>
        <ul>
           <li>{{ $article->title }}</li>
            <li>{{ $article->body }}</li>
        </ul>

        <p>
            @foreach( $article -> tags as $tag)
                <a href="/articles?tag={{ $tag->name }}" > {{ $tag->name }} </a>
            @endforeach
        </p>




    </div>
@endsection
