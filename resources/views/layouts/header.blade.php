
<!DOCTYPE html>
<html>
<head>
    <title> برندة</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="loading_icon" content="{{ asset('images/icons/load.gif') }}">
    <link rel="stylesheet" href="{{ asset('lib/dropzone/dropzone.css') }}" type="text/css">
    <link rel="stylesheet"  href="{{ asset('lib/lightslider-master/src/css/lightslider.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" >
    <link rel="stylesheet" href="{{ asset('css/w3.css') }}">
    <link rel="stylesheet" href="{{ asset('css/w3-colors-windows.css') }}">
    <link rel="stylesheet" href="{{ asset('css/w3-colors-flat.css') }}">
    <link rel="stylesheet" href="{{ asset('lib/fontawesome-free-5.0.13/web-fonts-with-css/css/fontawesome-all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('lib/fontawesome-free-5.0.13/web-fonts-with-css/webfonts/FontAwesome.otf') }}">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.css') }}">

    <!-- range slider for agar list page = its work only in header -->
    <link rel="stylesheet" href="{{ asset('css/ion.rangeSlider.css')}}"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="{{ asset('js/ion.rangeSlider.js') }}"></script>

    <link rel="stylesheet" href="{{ asset('css/agarsList.css') }}">

    <!-- For messenger page  -->
    <script src="https://js.pusher.com/5.0/pusher.min.js"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- genral css file -->
    <link rel="stylesheet" href="{{ asset('css/general.css') }}">

</head>
