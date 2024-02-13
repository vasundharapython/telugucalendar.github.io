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
                <div class="col text-center bgred  text-white brb"><h4>ముహూర్తాలు</h4></div>
            </div>
            <div class = "mt-3">
                <table >
                  <thead>
                    <th class = "text-center">Date</th>
                    <th class = "text-center">Festival</th>
                  </thead>
                  <tbody>
                  @foreach($muhurthalu as $mh)
            @foreach ($nelalu as $nl)
            @if($nl->id == $mh->month_id)
                       <tr >
                        <td class = "p-2 text-center">{{$mh->date}}</td>
                        <td class = "w-25 p-2 text-center">{{$mh->muhurtham}}</td>
                       </tr>
                       @endif
            @endforeach
@endforeach
                  </tbody>
                </table>
                </div>
            <!-- @foreach($muhurthalu as $mh)
            @foreach ($nelalu as $nl)
            @if($nl->id == $mh->month_id)
            <div class="row  borderp ">
                <div class="col-lg-6 col-xs-12 text-center ">{{$mh->date}}  </div>
                <div class="col text-center">{{$mh->muhurtham}}</div>
                <hr>
            </div>
            @endif
            @endforeach
@endforeach -->


      </div>
    </div>
    </div>

  @include('include.footer')



			<!-- loader -->
			@include('include.script')

		</body>
		</html>
