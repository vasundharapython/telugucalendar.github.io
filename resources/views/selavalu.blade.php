<!DOCTYPE html>
<html lang="en">
<head>
	@include('include.css')
</head>
<body>
    @include('include.nav')
    <div class="container-fluid bgmain box12 mt-2">
        <div class=" container  ">
          <div class="row">
              <div class="col text-center bgred  text-white brb"><h4>సెలవుదినం</h4></div>
          </div>
          @foreach($month as $m)
          <div class="row  borderp ">
              <div class="col-lg-6 col-xs-12 text-center "><b>{{$m->date}}</b>  </div>
              <div class="col text-center">{{$m->govtselavu}}</div>
              <hr>
          </div>
@endforeach


      </div>

  @include('include.footer')



			<!-- loader -->
			@include('include.script')

		</body>
		</html>
