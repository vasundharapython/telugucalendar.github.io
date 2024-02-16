<!DOCTYPE html>
<html lang='en'>
  <head>

    <meta charset='utf-8' />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href = "../scss/calendar.scss">
    <style>
      /* Add your custom CSS styles here */
      body {
        font-family: Arial, sans-serif;
      }

      #calendar {
        width: 80%;
        margin: 0 auto;
      }

      .fc-day {
        background-color: lightblue;
      }

      /* Customize other styles as needed */

    </style>
    <script src='https://code.jquery.com/jquery-3.6.0.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js'></script>
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
          initialView: 'dayGridMonth',
          headerToolbar: {
            left: 'prev,next',
            center: 'title',
            right: 'dayGridMonth,dayGridDay'
          },

        });
        events.push()
        calendar.render();
      });
    </script>
  </head>
  <body>
    <div id='calendar'></div>

</section>
<div class="container-fluid mt-3 ">
<div class="shodowb">

    <div class="row bg1 mx-1  brb   text-center">
        <div class="col text-white">ఉపవాసం రోజులు</div>
        </div>
<section class="layout2  ">

<div class="text-center borderrb "> ⚫ <br/>అమావాస్య <b></b> <br/> 17 సోమవారం </div>
<div class="text-center borderb">🔘 <br/> పూర్ణిమ  <br/> 3 సోమవారం</div>
<div class="text-center borderrb">   ఏకాదశి <br/> 13 గురు, 29 శని </div>
<div class="text-center borderb">ప్రదోష<br/> 29 శని, 14శుక్ర, 30 ఆది</div>
<div class="text-center borderrb">షష్టి<br/> 08 శని, 24 సోమ </div>
<div class="text-center borderb">చవితి <br/> 21 శుక్రవారము </div>
<div class="text-center borderrb">శివరాత్రి<br/>15 శనివారము </div>
<div class="text-center borderb">సంకటహర చతుర్థి<br/>07 శుక్రవారము </div>

</section>

<div class="row bg1 mx-1 mt-2 brb mt-2 text-white text-center">
        <div class="col text-white  ">పండుగలు</div>

        </div>

<section class="layout6 left ">
    <div>29 మొహర్రం</div>


</section>

<div class="row bg1 mx-1 brb mt-2  text-white text-center">
        <div class="col text-white">ప్రభుత్వ సెలవుదినం</div>

        </div>

<section class="layout6 left ">
    <div>29 మొహర్రం</div>


</section>

<div class="row bg1 mx-1 brb text-white text-center">
    <div class="col text-white ">ముఖ్యమైన రోజులు</div>
</div>

<section class="layout6 left ">
    <div>1 శని త్రయోదశి</div>
    <div>2 శివ పవిత్రారంభం</div>
    <div>3 మహా షాడ వ్యాసపూజ, యతీనం</div>
    <div>4 చాతుర్మాస్య వ్రతారంభం</div>

</section>
<section class="layout6 left ">
    <div>5 చాతుర్మాస్య విదియ</div>
    <div>6 పునర్వసు కార్తె రా.3.49</div>
    <div>11 ప్రపంచ జనాభా దినోత్సవం</div>
    <div class="txtsm">13 బోనాల జాతర, మతత్రయ ఏకాదశి</div>

</section>
<section class="layout6 left ">
    <div>17 దక్షిణాయన పుణ్యకాలం ప్రారంభం, కర్కాటక సంక్రమణం, సర్వ అమావాస్య</div>

    <div>18 అంతర్జాతీయ నెల్సన్ మండేలా దినోత్సవం</div>
    <div>20 పుష్యమికార్తె తె.5.22</div>
    <div>24 జాతీయ థర్మల్ ఇంజనీర్ దినోత్సవం</div>


</section>
<section class="layout6 left ">
    <div>26 కార్గిల్ విజయ్ దివస్ (కార్గిల్ విజయ దినం)</div>
    <div>29 మతత్రయ ఏకాదశి, అంతర్జాతీయ పులుల దినోత్స</div>


</section>

  </body>
</html>

{{--<!DOCTYPE html>
<html>
    <head>
        <title>Calendar</title>
    </head>
    <body>
        <div id="calendar">
            <!-- Calendar rendering here -->
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const calendar = document.getElementById('calendar');

                // Initialize your calendar component here (e.g., FullCalendar)
//var month = @json($events);
                // Add a click event handler for dates
                calendar.addEventListener('click', function(event) {
                    if (event.target.classList.contains('calendar-date')) {
                        const clickedDate = event.target.getAttribute('data-date');
 //events: month,
                        // Redirect to the show route with the clicked date
                        window.location.href = `/calendar/${clickedDate}`;
                    }
                });
                calendar.render();
            });
        </script>
    </body>
</html>--}}
