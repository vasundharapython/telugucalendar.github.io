<!DOCTYPE html>
<html lang="en">
<head>
	@include('include.css')
</head>
<body style="font-family: Ramabhadra; font-size: 22px;">
    <div class="google-translator lang" id="google_translate_element"></div>
    @include('include.nav')
    <div class="container-fluid">

        <div class="box12  ">
            @foreach($bhakthigeetam as $bg)
            <h3 class="text-center p-3 bgred">{{$bg->title}} </h3> <br>
             <p class="text-center"> <img src="" alt="" srcset="" ></p>  <br>

             <h5 class="p-5 ">అను పల్లవి </h5>
             <div class="pl-5 ">
                 <p >{!! $bg->description !!}</p>
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
