<!DOCTYPE html>
<html lang="en">
<head>
	@include('include.css')
</head>
<body class="head11" style="font-family: Ramabhadra; font-size: 22px;">
    <div class="content">
    <div class="google-translator lang" id="google_translate_element"></div>
    @include('include.nav')
    <div class="container-fluid bgmain box12 mt-2">
        <div class=" container  ">
          <div class="row">
              <div class="col text-center bgred  text-white brb"><h4>పండుగలు</h4></div>
          </div>
          <div class = "mt-3">
                <table>
                  <thead>
                    <th class = "text-center">Date</th>
                    <th class = "text-center">Festival</th>
                  </thead>
                  <tbody>
                  @foreach($month as $m)
                       <tr >
                        <td class = "p-2 text-center">{{$m->date}}</td>
                        <td class = "w-25 p-2 text-center">{{$m->pandugalu}}</td>
                       </tr>
                    @endforeach
                  </tbody>
                </table>
                </div>
          <!-- @foreach($month as $m)
          <div class="row  borderp ">
              <div class="col-lg-6 col-xs-12 text-center "><b>{{$m->date}}</b>  </div>
              <div class="col text-center">{{$m->pandugalu}}</div>
              <hr>
          </div>
          @endforeach -->


      </div>
    </div>
    </div>
</div>

  @include('include.footer')



			<!-- loader -->
			@include('include.script')

		</body>
		</html>
