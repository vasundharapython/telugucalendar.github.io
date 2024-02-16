<!DOCTYPE html>
<html lang="en">
<head>
	@include('include.css')
</head>
<body style="font-family: Ramabhadra; font-size: 22px;">
    <div class="google-translator lang" id="google_translate_element"></div>
    @include('include.nav')
    <div class="container-fluid bgmain box12 mt-2">
        <div class=" container  ">
          <div class="row">
              <div class="col text-center bgred  text-white brb"><h4>భక్తిగీతం</h4></div>
          </div>
          @foreach($bhakthicategory as $bc)
          <div class="d-flex justify-content-start align-items-center">
            <img src="../images/bimg12.jpeg" alt="" srcset="" class="bimg ">
            <a href = "/bhakthigeethacategory/{{ $bc->slug }}"><p>{{$bc->title}}</p></a>
              <hr>
          </div>
          @endforeach

    </div>

    @include('include.footer')

    @include('include.script')

</body>
</html>
