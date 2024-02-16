<!DOCTYPE html>
<html lang="en">
<head>
	@include('include.css')
</head>
<body class = "head11" style="font-family: Ramabhadra; font-size: 22px;">
      <div class="content">
        <div class="google-translator lang" id="google_translate_element"></div>
        @include('include.nav')
        <div class="container-fluid bgmain box12">
            <div class=" container  mt-2 ">
                <div class="row">
                    <div class="col text-center bgred  text-white brb"><h4>సంకటహర చతుర్థి - చంద్రోదయ కాలం</h4></div>
                </div>
                <div class = "mt-3">
                <table >
                  <thead>
                    <th class = "text-center">Month</th>
                    <th class = "text-center">Date</th>
                    <th class = "text-center">Description</th>
                  </thead>
                  <tbody>
                    @foreach($sankatahari as $st)
                       <tr >
                        <td class = "p-2 text-center">{{$st->month}}</td>
                        <td class = "w-25 p-2 text-center">{{$st->date}}</td>
                        <td class = "p-2">{!! $st->description !!}</td>
                       </tr>
                    @endforeach
                  </tbody>
                </table>
                </div>
                <!-- @foreach($sankatahari as $st)
                <div class="row  borderp ">
                    <div class="col text-center"><b>{{$st->month}}</b></div>
                    <div class="col-lg-6 col-xs-12 text-center "><b>{{$st->date}}</b>  </div>
                    <div class="col text-center">{{$st->description}}</div>
                    <hr>
                </div>
    @endforeach -->


          </div>
        </div>
        </div>

  @include('include.footer')

@include('include.script')

		</body>
		</html>
