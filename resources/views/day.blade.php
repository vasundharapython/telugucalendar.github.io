{{--<!DOCTYPE html>
<html lang="en">
<head>
	@include('include.css')
</head>
<body>
    @include('include.nav')
    @foreach($calendar as $cld)
    @if($cld->date == now()->format('d-m-Y'))
<div class="topbox p-2 pt-1">
    <div class="mainbox bxshadow">
        <section class="layout ">
            <div class="arrow pt-5"> <a href="{{url('yesterday')}}">  </a></div>
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
            <div class="arrow pt-5"> <a href="{{url('yesterday')}}">  </a></div>
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
		</html>--}}


        <!DOCTYPE html>
        <html lang="te">
        <head>
            @include('include.css')
        </head>
        <body style="font-family: Ramabhadra; font-size: 22px;">
            <div class="google-translator lang" id="google_translate_element"></div>
            @include('include.nav')
            <section class="layout11">
                <div class="grow1 bg-white boxs text-info text-center brb "> <a href = "{{url('calendar')}}"><h3 class = "text-info">మాస వీక్షణ</h3></a></div>
            </section>
            {{--@if($cld->date == now()->format('d-m-Y'))--}}
        <div class="topbox p-2 pt-1">
            <div class="mainbox bxshadow">
                <section class="layout ">
                    <div class="arrow pt-5"> <button class="arrowbg p-1 px-2 text-white" id="prevDate"><</button>{{--<a href=""> <span class="arrowbg p-1 px-2 text-white"><</span> </a>--}}</div>
                    <div>
                        <div class="text-center">
                            <h4 class="pt-4"></h4>
                           {{-- @php
                                $date = $cld->date;
                                $year = date('l', strtotime($date));

                                $month = date('F', strtotime($date));
                            @endphp
                            <h4>{{$year}}-{{$month}}</h4>--}}
                            <date> <span id="currentDate"></span></date>
                            <div class="col-lg-12  col-xs-12 col-sm-12 ">
                                <p id = "heading">{{--{{$cld->heading}}--}}</p>
                            </div>

                        </div>
                    </div>
                    <div class="arrow pt-5 "><button class="arrowbg p-1 px-2 text-white" id="nextDate">></button> {{--<a href="" > <span class="arrowbg p-1 px-2 text-white"> ></span></a> --}}</div>

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
            <div class="text-center"><p id = "thidhi"></p>{{--{{$cld->thidhi}}--}}</div>
            <div class="text-center"><p id = "nakshatram"></p>{{--{{$cld->nakshatram}}--}}</div>
          </section>
        </div>

        <div id = "dataContainer"></div>

        <div class="container-fluid bg-white p-3 shadow px-3 mt-3">
          <section class="layout2">
              <div class="bgred text-center text-white brb">రాహుకాలం</div>
              <div  class="bgred text-center text-white brb">యమగండం</div>
              <!-- <div class="text-center"> సా . 4:30 నుండి 6:00 వరకు </div> -->
              <div class="text-center"><p id = "rahukalam"></p>{{--{{$cld->rahukalam}}--}}</div>
              <div class="text-center"><p id = "yamagandam"></p>{{--{{$cld->yamagandam}}--}}</div>
            </section>
            <section class="layout3">
              <div class="bgred text-center text-white brb"> దుర్ముహూర్తం</div>
              <div class="text-center"><p id = "durmuhurtham"></p>{{--{{$cld->durmuhurtham}}--}}  </div>
            </section>
            <section class="layout3">
              <div class="bgred text-center text-white brb">వర్జ్యము</div>
              <div class="text-center txtsm">  <p id = "varjyamu"></p>{{--{{$cld->varjyamu}}--}}</div>
            </section>

        </div>
        {{--@endif--}}

          @include('include.footer')



                    <!-- loader -->
                    @include('include.script')
                    {{--<script>
                         const currentDateElement = document.getElementById('currentDate');
                const prevDateButton = document.getElementById('prevDate');
                const nextDateButton = document.getElementById('nextDate');

                // Initialize the current date to today
                let currentDate = new Date();

                //const backendEndpoint = '/your-backend-endpoint';
                // Function to display the current date
                function displayCurrentDate() {
                    const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
                    currentDateElement.textContent = currentDate.toLocaleDateString();
                }


                const backendEndpoint = '{{ route('fetch.data') }}';
                function loadDataForDate(){
                    const formattedDate = currentDate.toLocaleDateString();
                    console.log(formattedDate);
                    /*$.ajax({
                        type:'get',
                        url:'{{route('fetch.data')}}',
                        data:{'id':formattedDate},
                        dataType:'json',
                        success:function(data){
                            console.log(data.headings);
                        },
                        error:function(){

                        }
                    });*/
                    fetch(`/fetch-data/${date}`)
                    .then(response => response.json())
                    .then(data => {
                        console.log(data);
                        //document.getElementById('dateElement').textContent = data.date;
                        document.getElementById('heading').textContent = data.heading;
                        document.getElementById('thidhi').textContent = data.thidhi;
                        document.getElementById('nakshatram').textContent = data.nakshatram;
                        document.getElementById('rahukalam').textContent = data.rahukalam;
                        document.getElementById('yamagandam').textContent = data.yamagandam;
                        document.getElementById('durmuhurtham').textContent = data.durmuhurtham;
                        document.getElementById('varjyamu').textContent = data.varjyamu;
                        // Update your HTML elements with the fetched data
                        // For example, update elements with data.date, data.heading, etc.
                        // Example: document.getElementById('dateElement').textContent = data.date;
                    })
                    .catch(error => {
                        console.error('Error fetching data:', error);
                    });
                }

                // Function to update the date to the previous day
                function goToPreviousDate() {
                    currentDate.setDate(currentDate.getDate() - 1);
                    displayCurrentDate();
                }

                // Function to update the date to the next day
                function goToNextDate() {
                    currentDate.setDate(currentDate.getDate() + 1);
                    displayCurrentDate();
                }

                // Add event listeners to the buttons
                prevDateButton.addEventListener('click', goToPreviousDate);
                nextDateButton.addEventListener('click', goToNextDate);

                // Initial display of the current date
                displayCurrentDate();
                loadDataForDate();

                    </script>--}}
                    {{--<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                    <script>
                        //const currentDateElement = document.getElementById('currentDate');
                        // Function to handle the AJAX request
                        function fetchData() {
                            var formattedDate =  currentDate.toLocaleDateString()// Replace with your date

                            $.ajax({
                                type: 'get',
                                url: '{{ route('fetch.data') }}', // Replace with your Laravel route
                                data: { 'id': formattedDate },
                                dataType: 'json',
                                success: function(data) {
                                    console.log(data);
                                    console.log(data.headings);
                                },
                                error: function() {
                                    console.error('An error occurred while fetching data.');
                                }
                            });
                        }

                        // Attach the fetchData function to a button click event
                        $(document).ready(function() {
                            $('#fetchDataButton').click(function() {
                                fetchData();
                            });
                        });
                    </script>--}}
                    {{--<script>
                        $(document).ready(function(){
                            var Date=$('#date').text();
                            console.log(date);
                        });
                    </script>--}}
                    <script>
                        const currentDateElement = document.getElementById('currentDate');
                        //console.log(currentDateElement);
                        //const Date = document.getElementById('date');
                        //console.log(Date);
                        //var Date = currentDate.getDate();
                        //console.log(Date);
                        const prevDateButton = document.getElementById('prevDate');
                        const nextDateButton = document.getElementById('nextDate');

                        // Initialize the current date to today
                        let currentDate = new Date();
                        console.log(currentDate);

                        // Function to display the current date
                        function displayCurrentDate() {
                            const options = { weekday: 'long' };
                            const dayName = currentDate.toLocaleDateString('te', options);
                            const day = currentDate.getDate();
                            const month = currentDate.getMonth() + 1; // Months are zero-based
                            const year = currentDate.getFullYear();
                            const formattedDay = day < 10 ? `0${day}` : day;
    const formattedMonth = month < 10 ? `0${month}` : month;

    // Create the date string in "dd-mm-yyyy" format
    const formattedDate = `${formattedDay}-${formattedMonth}-${year}`;
    const displayString = `${formattedDate}, ${dayName}`;
    // Assuming currentDateElement is an HTML element where you want to display the date
    currentDateElement.textContent = displayString;
                            //currentDateElement.textContent = currentDate.toLocaleDateString('te', options);
                        }

                        function loadDataForDate(date) {
                            fetch(`/fetch-data/${date}`)
                                .then(response => response.json())
                                .then(data => {
                                    // Handle the fetched data as needed
                                    console.log(data);
                                    document.getElementById('heading').textContent = data.heading;
                        document.getElementById('thidhi').textContent = data.thidhi;
                        document.getElementById('nakshatram').textContent = data.nakshatram;
                        document.getElementById('rahukalam').textContent = data.rahukalam;
                        document.getElementById('yamagandam').textContent = data.yamagandam;
                        document.getElementById('durmuhurtham').textContent = data.durmuhurtham;
                        document.getElementById('varjyamu').textContent = data.varjyamu;
                                })
                                .catch(error => {
                                    console.error('Error fetching data:', error);
                                });
                        }

                        // Function to update the date to the previous day
                        function goToPreviousDate() {
                            currentDate.setDate(currentDate.getDate() - 1);
                            displayCurrentDate();
                            loadDataForDate(currentDate.toISOString().split('T')[0]);
                        }

                        // Function to update the date to the next day
                        function goToNextDate() {
                            currentDate.setDate(currentDate.getDate() + 1);
                            displayCurrentDate();
                            loadDataForDate(currentDate.toISOString().split('T')[0]);
                        }

                        // Add event listeners to the buttons
                        prevDateButton.addEventListener('click', goToPreviousDate);
                        nextDateButton.addEventListener('click', goToNextDate);

                        // Initial display of the current date
                        displayCurrentDate();
                        loadDataForDate(currentDate.toISOString().split('T')[0]);
                    </script>

                </body>
                </html>
                {{--<!DOCTYPE html>
                <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Date Navigation</title>
                </head>
                <body>
                    <div>
                        <button id="prevDate">Previous Date</button>
                        <span id="currentDate"></span>
                        <button id="nextDate">Next Date</button>
                    </div>
                <script>
                    // Get references to HTML elements
                const currentDateElement = document.getElementById('currentDate');
                const prevDateButton = document.getElementById('prevDate');
                const nextDateButton = document.getElementById('nextDate');

                // Initialize the current date to today
                let currentDate = new Date();

                // Function to display the current date
                function displayCurrentDate() {
                    const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
                    currentDateElement.textContent = currentDate.toLocaleDateString('en-US', options);
                }

                // Function to update the date to the previous day
                function goToPreviousDate() {
                    currentDate.setDate(currentDate.getDate() - 1);
                    displayCurrentDate();
                }

                // Function to update the date to the next day
                function goToNextDate() {
                    currentDate.setDate(currentDate.getDate() + 1);
                    displayCurrentDate();
                }

                // Add event listeners to the buttons
                prevDateButton.addEventListener('click', goToPreviousDate);
                nextDateButton.addEventListener('click', goToNextDate);

                // Initial display of the current date
                displayCurrentDate();

                </script>
                </body>
                </html>--}}

