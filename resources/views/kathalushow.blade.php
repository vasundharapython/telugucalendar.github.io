<!DOCTYPE html>
<html lang="en">
<head>
	@include('include.css')
</head>
<body>
    @include('include.nav')
    <div class="container-fluid">

        <div class=" box12 bgmain pt-1">
            @foreach($kathalu as $k)

                      <h3 class="bgred  text-white text-center brb">{{$k->title}}</h3>
          <div class="row mt-4">
              <div class="col-lg-5 m-1 col-xs-12  "><img src="" alt="" srcset="" height="400px" class="img-fluid" ></div>
              <div class="col-lg-5 m-1 col-xs-12 text-justify   mt-5"><p>{!! $k->description !!}</p> </div>

          </div>
        @endforeach
      </div>
      </div>

  @include('include.footer')



			<!-- loader -->
			@include('include.script')

		</body>
		</html>
