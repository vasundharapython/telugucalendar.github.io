<!DOCTYPE html>
<html lang="en">
<head>
	@include('include.css')
</head>
<body style="font-family: Ramabhadra; font-size: 22px;">
    @include('include.nav')
    <div class="container-fluid bgmain box12">
        <div class=" container  mt-2 ">
          <div class="row">
              <div class="col text-center bgred  text-white brb"><h4>పంచాంగము</h4></div>
          </div>
          @foreach($calendar as $cld)
        @if($cld->date == now()->format('d-m-Y'))
        <div class="row">
            <div class="col text-center bgred  text-white brb"><h4>{{$cld->date}}</h4></div>
        </div>
          <div class="row  borderp ">
              <div class="col-lg-6 col-xs-12 text-center "><b>తిథి</b>  </div>
              <div class="col text-center">{{$cld->thidhi}}</div>
              <hr>
          </div>
          <div class="row borderp mt-1">
              <div class="col-lg-6 col-xs-12 text-center"> <b> నక్షత్రం</b></div>
              <div class="col text-center">{{$cld->nakshatram}}</div>
              <hr>
          </div>



          <div class="container-fluid bg-white p-3 shadow px-3 mt-3">
              <section class="layout2">
                  <div class="bgred text-center text-white brb">రాహుకాలం</div>
                  <div  class="bgred text-center text-white brb">యమగండం</div>
                  <!-- <div class="text-center"> సా . 4:30 నుండి 6:00 వరకు </div> -->
                  <div class="text-center">{{$cld->rahukalam}}</div>
                  <div class="text-center">{{$cld->yamagandam}}</div>
                </section>
                <section class="layout3">
                  <div class="bgred text-center text-white brb"> దుర్ముహూర్తం</div>
                  <div class="text-center">{{$cld->durmuhurtham}}  </div>
                </section>
                <section class="layout3">
                  <div class="bgred text-center text-white brb">వర్జ్యము</div>
                  <div class="text-center txtsm">  {{$cld->varjyamu}}</div>
                </section>

            </div>
        </div>
@endif
@endforeach


      </div>

  @include('include.footer')



			<!-- loader -->
			@include('include.script')

		</body>
		</html>
