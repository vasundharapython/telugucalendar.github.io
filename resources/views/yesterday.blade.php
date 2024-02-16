<!DOCTYPE html>
<html lang="en">
<head>
	@include('include.css')
</head>
<body>
    @include('include.nav')
    <section class="layout11">
        <div class="grow1 bg-white boxs text-info text-center brb "> <a href = "{{url('calendar')}}"><h3 class = "text-info">మాస వీక్షణ</h3></a></div>
    </section>
    @foreach($calendar as $cld)
    @php
        $date = date($cld->date);
        //echo $date;
        $yesterday = date('Y-m-d', strtotime($date. ' - 1 days'));
        echo $yesterday;
    @endphp
    @if($cld->date == now()->yesterday()->format('d-m-Y'))
<div class="topbox p-2 pt-1">
    <div class="mainbox bxshadow">
        <section class="layout ">
            <div class="arrow pt-5"> <a href="{{url('yesterday')}}"> <span class="arrowbg p-1 px-2 text-white"><</span> </a></div>
            <div>
                <div class="text-center">
                    <h4 class="pt-4"></h4>
                    @php
                        $date = $cld->date;
                        $year = date('l', strtotime($date));

                        $month = date('F', strtotime($date));
                    @endphp
                    <h4>{{$year}}-{{$month}}</h4>
                    <date>{{$cld->date}}</date>
                    <div class="col-lg-12  col-xs-12 col-sm-12 ">

                        <p>{{$cld->heading}}</p>
                    </div>

                </div>
            </div>
            <div class="arrow pt-5 "> <a href="{{url('tomorrow')}}"> <span class="arrowbg p-1 px-2 text-white"> ></span></a> </div>

          </section>

</div>


</div>

<div class="container-fluid bg-white p-3 shadow px-3">
    <div class="col-12 text-center">
        <h5 class="red mt-2 "> <strong> </strong></h5>
        <!-- <hr style="height:1.5px;border-width:100%;color:#e3d838;background-color:#e33838"> -->
        <div class=""><img src="../images/bghr.png" alt="" width="70%" height="40px" srcset=""></div>
        <p5> </p5>
    </div>
</div>

<div class="container-fluid   p-3 shadow px-3 mt-3">
  <section class="layout2">
    <div class="bgred text-center text-white brb">తిథి</div>
    <div  class="bgred text-center text-white brb">నక్షత్రం</div>
    <!-- <div class="text-center"> సా . 4:30 నుండి 6:00 వరకు </div> -->
    <div class="text-center">{{$cld->thidhi}}</div>
    <div class="text-center">{{$cld->nakshatram}}</div>
  </section>
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

@endif
@endforeach

  @include('include.footer')



			<!-- loader -->
			@include('include.script')

		</body>
		</html>
