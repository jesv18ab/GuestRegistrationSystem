@extends('layouts.app')

@section('content')
    <div>
        @forelse($guests as $guest)
            <form action="/action_page.php">
                <label for="fname">First name:</label>
                <input type="text" id="fname" name="fname">  <br><br>
                <label for="lname">Last name:</label>
                <input type="text" id="lname" name="lname" value={{ $guest->name }} ><br><br>
                <input type="submit" value="Submit">
            </form>

            <h1 align="center"> hello world </h1>

            <h2>
                <a href="/guests/{{ $guest->name  }}" >
                    {{$guest->title}}
                </a>
            </h2>
    </div>
    @empty <p>
        No relevant articles
    </p>
    @endforelse
@endsection
