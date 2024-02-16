<!DOCTYPE html>
<html lang="te">

<head>
  @include('include.css')
</head>

<body style="font-family: Ramabhadra; font-weight: bold; font-size: 22px;">
  <div class="google-translator lang" id="google_translate_element"></div>
  @include('include.nav')
  <div class="container-fluid bgred ">
    @foreach($calendar as $cld)
    @if($cld->date == now()->format('d-m-Y'))
    <section class="layout11">
      <div class="grow1 bg-white boxs pt-1 text-info text-center brb ">
        <h3>{{$cld->date}}</h3>
      </div>
      @php
      //setlocale(LC_TIME, 'te_IN', 'te_IN.utf8', 'te_IN.utf-8', 'telugu');
      $date = $cld->date;
      //$day = strtotime($date);
      $day = date('l', strtotime($date));
      //$d = $day.toLocaleDateString('te');
      //$d = strftime('%A, %d %B, %Y', $day);
      $month = date('F', strtotime($date));
      //$m = $month.toLocaleDateString('te');
      @endphp
      <div class="grow1 bg-white boxs pt-1 text-info text-center brb">
        <h4>{{$day}}-{{$month}}</h4>
      </div>
    </section>
    @endif
    @endforeach
    <div class="sec-end mt-2"></div>

    <section class="layoutbox mt-2 text-center boxs">
      <div class="bg-white boxs pt-1 "><a href="{{url('day')}}"><img src="../images/Day.jpg" alt="" srcset="" class="bimg "> <br> దిన పంచాంగం</a></div>
      <div class="bg-white boxs pt-1"><a href="{{url('calendar')}}"><img src="../images/Calender.png" alt="" srcset="" class="bimg"> <br> మాస వీక్షణ</a></div>
      <div class="bg-white boxs pt-1 "><a href="{{url('bhakthigeethacategory')}}"><img src="../images/bhakthigeetham.png" alt="" srcset="" class="bimg"> <br> భక్తి గీతాలు - హారతి పాటలు</a></div>
      <div class="bg-white boxs pt-1"><a href="{{url('sankataharachaturthi')}}"><img src="../images/bimg7.webp" alt="" srcset="" class="bimg"> <br> సంకటహర చతుర్థి - చంద్రోదయ కాలం</a></div>
      <div class="bg-white boxs pt-1"><a href="{{url('ekadasi')}}"><img src="../images/vishnu.jpg" alt="" srcset="" class="bimg "><br> ఏకాదశి ఉపవాసం - ద్వాదశి పారణ</a></div>
      <div class="bg-white boxs pt-1"><a href="{{url('sankalpalu')}}"><img src="../images/pranthalu.png" alt="" srcset="" class="bimg"><br> వివిధ ప్రాంతాల సంకల్పాలు</a></div>
      <div class="bg-white boxs pt-1"><a href="{{url('stotraluCategory')}}"><img src="../images/sthothram.webp" alt="" srcset="" class="bimg"><br> స్తోత్రములు</a></div>
      <div class="bg-white boxs pt-1"><a href="{{url('AnubandhamCategory')}}"><img src="../images/sthothram.webp" alt="" srcset="" class="bimg"><br>దేవతార్చన</a></div>
      <div class="bg-white boxs pt-1"><a href="{{url('vedasukthuluCategory')}}"><img src="../images/sthothram.webp" alt="" srcset="" class="bimg"><br>ఇతరములు</a></div>
      <div class="bg-white boxs pt-1 "><a href="{{url('muhurthalu')}}"><img src="../images/bimg9.jpeg" alt="" srcset="" class="bimg  "> <br> ముహూర్తములు</a></div>
      <div class="bg-white boxs pt-1"><a href="{{url('pandugalu')}}"><img src="../images/festival.webp" alt="" srcset="" class="bimg"><br> పండుగలు</a></div>
      <div class="bg-white boxs pt-1"><a href="{{url('service')}}"><img src="../images/Book_a_Pooja.jpg" alt="" srcset="" class="bimg"><br>మీ... సేవాలు బుక్ చేసుకోండి</a></div>
      <div class="bg-white boxs pt-1"><a href="{{url('jobportal')}}"><img src="../images/job_Portal.jpg" alt="" srcset="" class="bimg"><br> ఉద్యోగ పోర్టల్</a></div>
      <div class="bg-white boxs pt-1"><a href="{{url('about')}}"><img src="../images/sthothram.webp" alt="" srcset="" class="bimg"><br>మా గురుంచి</a></div>
      <div class="bg-white boxs pt-1"><a href="{{url('blog_gallery')}}"><img src="../images/sthothram.webp" alt="" srcset="" class="bimg"><br>బ్లాగ్ & గ్యాలరీ</a></div>

    </section>
    <div class="card container-fluid mt-4">
      <div id="imageCarousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
          @foreach($add as $key=>$ad)
          <div class="carousel-item{{ $loop->first ? ' active' : '' }}">
            <div class="row">
              <div class="col">
                <img src="{{ asset('storage/'.$ad->image) }}" class="d-block carousel-image" alt="Image {{ $key + 1 }}">
              </div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>



  </div>
  <div class="mt-4">
    @include('include.footer')
  </div>



  <!---pop up modal starts---------------->

  <div class="ad-container  d-none">

  <img src = "{{ asset('storage/'.$popup->image) }}"
    <!-- <img src="../images/bimg9.jpeg" alt=""> -->
    <div id="cancelIcon" class="">


      <i class="fa-solid fa-rectangle-xmark fa-lg" style="color: #ffa70f;"></i>
    </div>

  </div>

  <!-- pop up modal ends---------------- -->
  <!-- loader -->
  @include('include.script')

</body>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- Script to enable auto-scrolling -->
<!-- ad script starts -->
<script>
  document.addEventListener('DOMContentLoaded', function() {
    let adModel = document.querySelector('.ad-container');
    setTimeout(function() {
      adModel.classList.remove("d-none");
    }, 1000);
    let cancelIcon = document.getElementById("cancelIcon");
    cancelIcon.addEventListener('click', function() {
      adModel.classList.add('d-none');
    })
  })
</script>
<!-- ad script ends -->
<script>
  $(document).ready(function() {
    $('#imageCarousel').carousel({
      interval: 3000, // Adjust the interval in milliseconds (e.g., 3000 = 3 seconds)
      pause: false // Set to true if you want to pause on hover
    });
  });
</script>
<script type="text/javascript">
  function googleTranslateElementInit() {
    new google.translate.TranslateElement({
      pageLanguage: 'en'
    }, 'google_translate_element');
  }
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

</html>

