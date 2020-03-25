@extends('layouts.app')

@section('content')
    <div>
        @forelse($articles as $article)
        <form action="/action_page.php">
            <label for="fname">First name:</label>
            <input type="text" id="fname" name="fname">  <br><br>
            <label for="lname">Last name:</label>
            <input type="text" id="lname" name="lname" value={{ $article->title }} ><br><br>
            <input type="submit" value="Submit">
        </form>

        <h1 align="center"> hello world </h1>

            <h2>
                <a href="/articles/{{ $article->id }}" >
                    {{$article->title}}
                </a>
            </h2>
{!! $article->excerpt !!}
    </div>
    @empty <p>
        No relevant articles
    </p>
    @endforelse
@endsection
