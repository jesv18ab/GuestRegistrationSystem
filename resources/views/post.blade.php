@extends('layouts.app')

    @section('content ')
        <div>
        <title>Document</title>

        <h1 align="center"> My Blog post </h1>

        <p> {{ $post->body  }} </p>
        </div>

@endsection
