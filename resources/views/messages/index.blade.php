<!DOCTYPE html>
<html>
	<head>
		<title>برندة </title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.css') }}">
    <script src="{{ asset('js/jquery-3.4.1.slim.min.js') }}"></script>
		<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
    <link rel="stylesheet" href="{{ asset('css/chat.css') }}">
    <link rel="stylesheet" href="{{ asset('css/w3.css')}}">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.js"></script>
		<link rel="stylesheet" href="{{ asset('css/w3-colors-flat.css') }}">
		<!-- for vue js app.js file -->
   <script src="{{ asset('js/app.js') }}" defer></script>
  </head>
    <!-- sidebar menu -->
      @include('layouts/aside')

    <body>

    <!-- Overlay effect when opening sidebar on small screens -->
    <div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>
    <!-- -->

    <div class="container-fluid" dir="rtl">
      <div  id="contact">
          <chat-app :user="{{ Auth::user() }}"></chat-app>
      </div>
    </div>

@include('layouts/footer')


<!-- Footer -->
<script type="text/javascript" src="{{ asset('js/script.js') }}">
</script>

</body>
