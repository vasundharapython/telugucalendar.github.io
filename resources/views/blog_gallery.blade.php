<!DOCTYPE html>
<html lang="en">
<head>
	@include('include.css')
</head>
<body class = "head11" style="font-family: Ramabhadra; font-weight: bold; font-size: 24px;">
    <div class="content">
        <div class="google-translator lang" id="google_translate_element"></div>
        @include('include.nav')
        <div class="container-fluid bgmain box12">
            <div class=" container  mt-2 ">
                <div class="row">
                    <div class="col text-center bgred  text-white brb"><h4>బ్లాగ్ & గ్యాలరీ</h4></div>
                </div>
                <div class="d-flex justify-content-start align-items-center">
            <!-- <img src="../images/Bakthi_Geethalu-transformed.jpeg" alt="" srcset="" class="bimg "> -->
            <a href = "{{url('blog')}}"><p>బ్లాగ్</p></a>
              <hr>
          </div>
          <div class="d-flex justify-content-start align-items-center">
            <!-- <img src="../images/Bakthi_Geethalu-transformed.jpeg" alt="" srcset="" class="bimg "> -->
            <a href = "{{url('galleries')}}"><p>గ్యాలరీ</p></a>
              <hr>
          </div>
          </div>
        </div>
        </div>

  @include('include.footer')

@include('include.script')

		</body>
		</html>
