@extends('layouts.app')

@section('content')


<div id="wrapper">
<div id="page" class="container">

    <form method="POST" action="/guests" style="border:1px solid #ccc">
        @csrf

        <div class="container">

            <h1>Aftal nyt møde</h1>
            <p>Udfyld venligst nedenstående formular, for at registrere en kommende besøgsperson.</p>
            <hr>

            <div>
                <label for="name"><h5><b>Navn</b></h5></label>
            <input class="input" type="text" placeholder="Indtast navn" name="name" id="name" required>
            </div>

            <div>
                <label align="center" for="expected_at"><h5><b>Indtast tid og dato for møde</b></h5></label>
                </div>
            <div >
                <input type="date" for="expected_at" name="expected_at">
                <input type="time" for="time" name="time">
            </div>
            <p >By creating an account you agree to our <a href="#" style="color:dodgerblue">Terms & Privacy</a>.</p>
<div class="field is-grouped">
            <div class="control">
                <button type="submit" class="button is-link">registrer</button>
            </div>
        </div>
        </div>
    </form>

</div>
</div>
@endsection
