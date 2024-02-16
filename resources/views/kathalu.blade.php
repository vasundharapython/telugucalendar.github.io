<!DOCTYPE html>
<html lang="en">
<head>
	@include('include.css')
</head>
<body class = "head11">
    <div class="content">
        <div class="google-translator lang" id="google_translate_element"></div>
        @include('include.nav')
        <div class="container-fluid bgmain box12">
            <div class=" container  mt-2 ">
                <div class="row">
                    <div class="col text-center bgred  text-white brb"><h4>ఏకాదశి ఉపవాసం - ద్వాదశి పారణ</h4></div>
                </div>
                <div class = "mt-3">
                <table >
                  <thead>
                    <th class = "text-center">Month</th>
                    <th class = "text-center">Date</th>
                    <th class = "text-center">Description</th>
                  </thead>
                  <tbody>
                  @foreach($ekadasi as $ek)
                       <tr >
                        <td class = "p-2 text-center"><b>{{$ek->month}}</b></td>
                        <td class = "w-25 p-2 text-center"><b>{{$ek->date}}</b></td>
                        <td class = "p-2 text-center"><b>{!! $ek->description !!}</b></td>
                       </tr>
                    @endforeach
                  </tbody>
                </table>
                </div>
                <!-- @foreach($ekadasi as $ek)
                <div class="row  borderp ">
                    <div class="col text-center"><b>{{$ek->month}}</b></div>
                    <div class="col-lg-6 col-xs-12 text-center "><b>{{$ek->date}}</b>  </div>
                    <div class="col text-center">{{$ek->description}}</div>
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
