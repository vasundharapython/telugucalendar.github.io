<!DOCTYPE html>
<html lang="en">
<head>
	@include('include.css')
</head>
<body class="head11" style="font-family: Ramabhadra; font-size: 22px;">
    <div class="content">
    <div class="google-translator lang" id="google_translate_element"></div>
    @include('include.nav')
    <div class="container-fluid bgmain box12">
        <div class=" container  mt-2 ">
            <div class="row">
                <div class="col text-center bgred  text-white brb"><h4> గ్యాలరీ</h4></div>
            </div>
            @foreach($gallery as $g)
            <div>
                <img src = "{{asset('storage/'.$g->image)}}" >
            </div>
            @endforeach
           

      </div>
    </div>
    </div>

  @include('include.footer')



			<!-- loader -->
			@include('include.script')

		</body>
		</html>
