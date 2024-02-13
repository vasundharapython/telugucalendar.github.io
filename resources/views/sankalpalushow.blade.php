<!DOCTYPE html>
<html lang="en">
<head>
	@include('include.css')
</head>
<body style="font-family: Ramabhadra; font-size: 22px;">
    <div class="google-translator lang" id="google_translate_element"></div>
    @include('include.nav')
    <div class="container-fluid bgmain">

        <div class="box12   pt-1">
            @foreach($sankalpalu as $sp)
            <h3 class="text-center brb bgred text-white mx-5 mt-5">{{$sp->title}}</h3>
            <div class="row mt-4">
                    <div class="col-lg-4 m-1 col-xs-12  text-justify text-white text-center"> <img src="" alt="" srcset="" class="img-fluid" ></div>
                    <div class="col-lg-7 m-1 col-xs-12 text-justify">
                        <p>{!! $sp->description !!}</p>
                    </div>
            </div>
            @endforeach

  @include('include.footer')



			<!-- loader -->
			@include('include.script')

		</body>
		</html>