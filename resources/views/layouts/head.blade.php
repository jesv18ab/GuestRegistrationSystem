<!--Here we get our title name and load js and css -->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- ajax calls -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('assets/js/app.js') }}" defer></script>
    <script  src="{{ asset('assets/js/ajaxCalls.js') }}" defer></script>
    <script  src="{{ asset('assets/js/icons.js') }}" defer></script>
    <script  src="{{ asset('assets/js/admin.js') }}" defer></script>
    <script  src="{{ asset('assets/js/guest.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('assets/scss/mainStyle.css') }}" rel="stylesheet">


</head>


