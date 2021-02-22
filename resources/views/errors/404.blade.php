@include('layouts/header')

  <body>
    <section class="container">
    	<div class="row">
  	  	<div class="col-md-8 offset-md-2">
  	  		<div class="w3-center errors_image">
  	  			<img src="{{ asset('images/error.gif') }}">
  	  			<p class="w3-xlarge w3-center">Opps 404 </p>
  	  			<p class="w3-xlarge w3-center w3-text-red w3-margin">الصفحة التي تبحث عنها غير موجودة</p>
  	  			<p> <a href="/" class="w3-large w3-center w3-margin"> الرجوع للصفحة الرئيسية </a> </p>
  	  		</div>
  	  	</div>
      </div>
    </section>
  </body>



</html>
