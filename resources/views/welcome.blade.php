@extends('layouts/app')

@section('content')
        <div class="flex-center position-ref full-height">
           <div class="content">
                <div class="title m-b-md">

                    @auth
                        h1, {{ Auth::user()->name }}
                        @else
                        Dette er startsiden
                    @endauth
                </div>

                <div class="links"  >

                    <a href="https://laravel.com/docs">Documentation</a>
                    <a href="https://laracasts.com">Larvel videos</a>
                    <a href="/registerGuest" acceskey="3" title="">Gæsteregistrering</a>
                    <a href="/guests" accesskey="4" title="">Se alle gæster</a>
                    <a href="/guestsRegistration" accesskey="5" title="">Gæsteside</a>
                    <a href="https://github.com/laravel/laravel">GitHub</a>
                    <a href= "https://www.coca-cola.dk/">Coca cola</a>

                </div>
            </div>
        </div>
@endsection
