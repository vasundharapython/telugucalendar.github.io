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
              <div class="col text-center bgred  text-white brb"><h4>పురాణాలు</h4></div>
          </div>
          @foreach($puranalu as $pn)
          <div class="d-flex justify-content-start align-items-center">
            <img src="../images/Puranalu.jpg" alt="" srcset="" class="bimg ">
            <a href = "/puranalu/{{ $pn->slug }}"><p>{{$pn->title}}</p></a>
              <hr>
          </div>
          @endforeach

      </div>

  @include('include.footer')

@include('include.script')

		</body>
		</html>
