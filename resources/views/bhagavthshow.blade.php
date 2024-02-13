<!DOCTYPE html>
<html lang="en">
<head>
	@include('include.css')
</head>
<body>
    @include('include.nav')
    <div class="container-fluid bgmain ">

        <div class="box12 ">
            @foreach($bhagavthgeetha as $bg)
         <div class="row   bgred  text-white brb text-center">
          <div class="col text-center"><p class="text-center   "> <img src="" alt="" srcset="" class="img-fluid" ></p>
         </div>
      </div>
          <div class="m-2 text-black">
              <img src="" alt="" srcset="">
              <div class="m-5">
              <p>{!! $bg->description !!}</p>
          </div>
          @endforeach
        </div>



      </div>

  @include('include.footer')



			<!-- loader -->
			@include('include.script')

		</body>
		</html>
