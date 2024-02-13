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
          @foreach($bhakthigeetam as $bg)
          @foreach ($bhakthicategory as $bc)
          @if($bc->id == $bg->category_id)
          <div class="d-flex justify-content-start align-items-center">
            <img src="../images/Bakthi_Geethalu-transformed.jpeg" alt="" srcset="" class="bimg ">
            <a href = "/bhakthigeetam/{{ $bg->slug }}"><p>{{$bg->title}}</p></a>
              <hr>
          </div>
          @endif
          @endforeach
          @endforeach

      </div>

  @include('include.footer')

@include('include.script')
<script type="text/javascript">
    function googleTranslateElementInit() {
        new google.translate.TranslateElement({ pageLanguage: 'en' }, 'google_translate_element');
    }
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

<script type="text/javascript"
    src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

		</body>
		</html>
