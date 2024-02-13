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
              <div class="col text-center bgred  text-white brb"><h4>వ్రతాలు</h4></div>
          </div>
          @foreach($vrathalu as $vt)
          <div class="d-flex justify-content-start align-items-center">
            <img src="../images/Vrathalu.jpg" alt="" srcset="" class="bimg ">
            <a href = "/vrathalu/{{ $vt->slug }}"><p>{{$vt->title}}</p></a>
              <hr>
          </div>
          @endforeach

      </div>

  @include('include.footer')

@include('include.script')

		</body>
		</html>
