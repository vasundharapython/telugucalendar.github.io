<!DOCTYPE html>
<html>
    <head>
        <title>HindhuDharmaChakram</title>
        <meta charset='utf-8' />
        <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js'></script>
        <link rel="stylesheet" href="../css/style.css">
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <!--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css" integrity="sha384-b6lVK+yci+bfDmaY1u0zE8YYJt0TZxLEAFyYSLHId4xoVvsrQu3INevFKo+Xir8e" crossorigin="anonymous">-->
        <!-- Link to Bootstrap CSS -->
        <!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css" rel="stylesheet">-->
        <!-- Link to Font Awesome CSS -->
        <!--<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.20.3/css/all.min.css" rel="stylesheet">-->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <!--<link href='https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css' rel='stylesheet'>-->
        <link href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css' rel='stylesheet'>
        <link rel="stylesheet" href="css/style2.css">
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/locales/te.js'></script>
        <script>

          document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var events = @json($events);
            // var selectedMonth = info.start.getMonth() + 1;
            // console.log(selectedMonth);
            var calendar = new FullCalendar.Calendar(calendarEl, {
                events: events.map(event => ({
                id: event.id,
                start: event.start_date,
                end: event.end_date,
                imageUrl: event.image,
                // color: '#ff5733',
                //color: getRandomColor(), // Generate a random color dynamically
            })),
            eventContent: function(info) {
        var eventStartDate = info.event.start;
        var eventEndDate = info.event.end;
        var currentDate = new Date(eventStartDate);

        while (currentDate <= eventEndDate) {
            var currentFormattedDate = currentDate.toISOString().split('T')[0];
            var dateCell = document.querySelector(`.fc-day[data-date="${currentFormattedDate}"]`);

            if (dateCell) {
                var imgElement = document.createElement('img');
                var imageUrl = '{{ asset("storage/") }}/' + info.event.extendedProps.imageUrl; // Adjust the path to your assets
                imgElement.src = imageUrl;
                imgElement.style.width = '50%'; // Set the width to fit the date box

                dateCell.innerHTML = ''; // Clear existing content

                // Set a fixed height for the date cell
                dateCell.style.height = '100px'; // Adjust the height as needed

                dateCell.appendChild(imgElement);
            }

            currentDate.setDate(currentDate.getDate() + 1); // Move to the next day
        }

        // Return the event's content (can be empty as we've already customized the date cells)
        return { html: '' };
    },
    //         eventContent: function(info) {
    //     var eventStartDate = info.event.start;
    //     var eventEndDate = info.event.end;
    //     var currentDate = new Date(eventStartDate);

    //     while (currentDate <= eventEndDate) {
    //         var currentFormattedDate = currentDate.toISOString().split('T')[0];
    //         var dateCell = document.querySelector(`.fc-day[data-date="${currentFormattedDate}"]`);

    //         if (dateCell) {
    //             dateCell.style.backgroundColor = '#ff5733'; // Set the background color for the entire date box
    //             dateCell.style.color = '#fff'; // Set text color to white for better visibility
    //         }

    //         currentDate.setDate(currentDate.getDate() + 1); // Move to the next day
    //     }

    //     // Return the event's content (can be empty as we've already customized the date cells)
    //     return { html: '' };
    // },
            // eventContent: function(info) {
            //     var eventDate = info.event.start;
            //     var formattedStartDate = eventDate.toISOString().split('T')[0];
            //     var formattedEndDate = info.event.end.toISOString().split('T')[0];

            //     // Customize the date cells using the event dates
            //     var currentDate = new Date(formattedStartDate);
            //     var endDate = new Date(formattedEndDate);
            //     while (currentDate <= endDate) {
            //         var currentFormattedDate = currentDate.toISOString().split('T')[0];
            //         var dateCell = document.querySelector(`.fc-day[data-date="${currentFormattedDate}"]`);
            //         if (dateCell) {
            //             dateCell.style.backgroundColor = getRandomColor();
            //             dateCell.style.color = '#fff'; // Set text color to white for better visibility
            //         }
            //         currentDate.setDate(currentDate.getDate() + 1); // Move to the next day
            //     }

            //     // Return the event's content (can be empty as we've already customized the date cells)
            //     return { html: '' };
            // },
                locale: 'te',
              dayMaxEventRows: true,
              datesSet: function(info) {
            var currentMonth = info.start.getMonth()+1; // Month is zero-based
            var monthNames = [ "జనవరి",
            "ఫిబ్రవరి",
            "మార్చి",
            "ఏప్రిల్",
            "మే",
            "జూన్",
            "జులై",
            "ఆగస్టు",
            "సెప్టెంబర్",
            "అక్టోబర్",
            "నవంబర్",
            "డిసెంబర్",];
            var monthName = monthNames[currentMonth];

            // You can now use the monthName variable as needed
            console.log("Current Month: " + monthName);
            loadDataForDate(monthName);
        },
                dateClick: function(info) {
                    window.location.href = "/date/"+info.dateStr;
                },
              initialView: 'dayGridMonth',
              themeSystem: 'bootstrap',
              dayMaxEventRows: 2,
              headerToolbar: {
                    left: 'prev,today,next',
                    center: 'title',
                    right: 'dayGridMonth' // user can switch between the two
                },
                buttonText: {
            today: 'ఈ రోజు', // Today button text in Telugu
            month: 'ఈ నెల', // Month button text in Telugu
        },
                //events: month,
                selectable: true,
            });

            calendar.render();
        //     function getRandomColor() {
        //     var letters = '0123456789ABCDEF';
        //     var color = '#';
        //     for (var i = 0; i < 6; i++) {
        //         color += letters[Math.floor(Math.random() * 16)];
        //     }
        //     return color;
        // }
            function loadDataForDate(month) {
                    console.log(month);
                    fetch(`/month-data/${month}`)
                        .then(response => response.json())
                        .then(data => {

            // Clear previous data
            document.getElementById('heading').textContent = data[0].heading;
            document.getElementById('update').innerHTML = '';
            document.getElementById('padate').innerHTML = '';
            document.getElementById('gsdate').innerHTML = '';
            document.getElementById('ipdate').innerHTML = '';
            document.getElementById('upavasalu').innerHTML = '';
            document.getElementById('pandugalu').innerHTML = '';
            document.getElementById('govtselavu').innerHTML = '';
            document.getElementById('importantdays').innerHTML = '';

            // Handle the fetched data as needed
            data.forEach(monthData => {
                const dat = monthData.date;
                console.log(monthData.date);
                const dateParts = dat.split('-');
const fullDate = new Date(dateParts[2], dateParts[1] - 1, dateParts[0]);
console.log(fullDate);
const dayNumber = fullDate.getDate();
console.log(dayNumber);
                // Create new elements for each month's data
                const updateElement = document.createElement('div');
                updateElement.textContent = dayNumber;
                document.getElementById('update').appendChild(updateElement);

                const padateElement = document.createElement('div');
                padateElement.textContent = dayNumber;
                document.getElementById('padate').appendChild(padateElement);

                const gsdateElement = document.createElement('div');
                gsdateElement.textContent = dayNumber;
                document.getElementById('gsdate').appendChild(gsdateElement);

                const ipdateElement = document.createElement('div');
                ipdateElement.textContent = dayNumber;
                document.getElementById('ipdate').appendChild(ipdateElement);

                const upavasaluElement = document.createElement('div');
                upavasaluElement.textContent = monthData.upavasalu;
                document.getElementById('upavasalu').appendChild(upavasaluElement);

                const pandugaluElement = document.createElement('div');
                pandugaluElement.textContent = monthData.pandugalu;
                document.getElementById('pandugalu').appendChild(pandugaluElement);

                const govtselavuElement = document.createElement('div');
                govtselavuElement.textContent = monthData.govtselavu;
                document.getElementById('govtselavu').appendChild(govtselavuElement);

                const importantdaysElement = document.createElement('div');
                importantdaysElement.textContent = monthData.importantdays;
                document.getElementById('importantdays').appendChild(importantdaysElement);
            });
        })
        .catch(error => {
            console.error('Error fetching data:', error);
        });
                }
          });

        </script>
      </head>
<body style="font-family: Ramabhadra; font-size: 22px;">
    <div class="google-translator lang" id="google_translate_element"></div>
    @include('include.nav')
  <div class="container-fluid ">
      <div class="response"></div>
      <section class="layout11">
        <div class="grow1 bg-white boxs text-info text-center brb m-3 "> <h3 id = "heading" class = "text-info"></h3></div>
    </section>

      <div id='calendar'></div>
  </div>
<div class="container-fluid mt-3 ">
<div class="shodowb">

    <div class="row bg1 mx-1 mt-2 brb mt-2 text-white text-center">
        <div class="col text-white">ఉపవాసం రోజులు</div>
        </div>
<section class="layout6 left  ">
    <div class = "row">
        <div class ="col text-center">
            <span id ="update"></span>
        </div>
        <div class ="col text-center">
            <span id ="upavasalu"></span>
        </div>
    </div>
 </div>

{{-- <div class="text-center borderrb "> ⚫ <br/>అమావాస్య <b></b> <br/> 17 సోమవారం </div>
<div class="text-center borderb">🔘 <br/> పూర్ణిమ  <br/> 3 సోమవారం</div>
<div class="text-center borderrb">   ఏకాదశి <br/> 13 గురు, 29 శని </div>
<div class="text-center borderb">ప్రదోష<br/> 29 శని, 14శుక్ర, 30 ఆది</div>
<div class="text-center borderrb">షష్టి<br/> 08 శని, 24 సోమ </div>
<div class="text-center borderb">చవితి <br/> 21 శుక్రవారము </div>
<div class="text-center borderrb">శివరాత్రి<br/>15 శనివారము </div>
<div class="text-center borderb">సంకటహర చతుర్థి<br/>07 శుక్రవారము </div> --}}

</section>

<div class="row bg1 mx-1 mt-2 brb mt-2 text-white text-center">
        <div class="col text-white  ">పండుగలు</div>

        </div>

<section class="layout6 left ">
    <div class = "row">
        <div class ="col text-center">
            <span id = "padate"></span>
        </div>
        <div class ="col text-center">
            <span id = "pandugalu"></span>
        </div>
    </div>
</section>

<div class="row bg1 mx-1 brb mt-2  text-white text-center">
        <div class="col text-white">ప్రభుత్వ సెలవుదినం</div>

        </div>

<section class="layout6 left ">
    <div class = "row">
        <div class ="col text-center">
            <span id = "gsdate"></span>
        </div>
        <div class ="col text-center">
            <span id = "govtselavu"></span>
        </div>
    </div>
</section>

<div class="row bg1 mx-1 brb text-white text-center">
    <div class="col text-white ">ముఖ్యమైన రోజులు</div>
</div>

<section class="layout6 left ">
    <div class = "row">
        <div class ="col text-center">
            <span id = "ipdate"></span>
        </div>
        <div class ="col text-center">
            <span id = "importantdays"></span>
        </div>
    </div>
</section>
  @include('include.footer')
</body>
<script type="text/javascript">
    function googleTranslateElementInit() {
        new google.translate.TranslateElement({ pageLanguage: 'en' }, 'google_translate_element');
    }
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

<script type="text/javascript"
    src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
</html>
