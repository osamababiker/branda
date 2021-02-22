@if(Session::has('info'))
  <div class="w3-modal" id="alert-box" style="display: block">
    <div class="w3-panel w3-modal-content w3-card-4 w3-padding-64 w3-animate-zoom" style="max-width:480px">
      <span onclick="document.getElementById('alert-box').style.display='none'"
      class="w3-button w3-large w3-display-topright">&times;</span>
      <h3 class="w3-center"> {{Session::get('info')}} </h3>
    </div>
  </div>
@endif

@if (Session::has('success'))
  <div class="w3-panel w3-green w3-display-container">
    <span onclick="this.parentElement.style.display='none'"
    class="w3-button w3-large w3-display-topright">&times;</span>
    <h3>Success!</h3>
		{{Session::get('alert')}}
	</div>
@endif
