<!DOCTYPE html>
<html lang="en">
<head>
	@include('include.css')
</head>
<body>
    @include('include.nav')
    <div class="container-fluid bgmain">

        <div class="box12  pt-5">
            @foreach($puranalu as $pn)
          <p class="text-center  "> <img src="" alt="" srcset="" class="img-fluid" ></p>
          <h3 class="text-center brb bgred text-white mx-5">{{$pn->title}}</h3>
          <div>
                <div class="col-lg-5 m-1 col-xs-12  text-center   centertxt">{{$pn->description}}</div>
          </div>
      <hr>
      @endforeach
        </div>



      </div>

  @include('include.footer')



			<!-- loader -->
			@include('include.script')

		</body>
		</html>
