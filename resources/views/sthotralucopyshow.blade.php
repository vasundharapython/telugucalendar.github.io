<!DOCTYPE html>
<html lang="en">
<head>
	@include('include.css')
</head>
<body style="font-family: Ramabhadra; font-size: 22px;">
    <div class="google-translator lang" id="google_translate_element"></div>
    @include('include.nav')
    <div class="container-fluid ">
        <div class="containe ">

          <div class="box12   pt-5">
            @foreach($sthotralucopy as $st)
            <h3 class="bgred text-center text-white brb mx-5">"{{$st->title}}"</h3>
            <div class="row mt-4 ">
                    <div class="col-lg-3 m-1 col-xs-12  text-justify   centertxt pl-5"><img src="" alt="" srcset="" class="img-fluid" ></div>
                      <div class="col-lg-8 m-1 col-xs-12 text-justify  ">
                        {!! $st->description !!}
                    </div>
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
