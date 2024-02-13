<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hindhudharmachakram</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css" integrity="sha384-b6lVK+yci+bfDmaY1u0zE8YYJt0TZxLEAFyYSLHId4xoVvsrQu3INevFKo+Xir8e" crossorigin="anonymous">
    <!-- Link to Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Link to Font Awesome CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.20.3/css/all.min.css" rel="stylesheet">


</head>


<body style="font-family: Ramabhadra; font-size: 22px;">
    <div class="google-translator lang" id="google_translate_element"></div>
@include('include.nav')
@include('include.service_nav')


    <div class="container-fluid px-1 box12">
        @if($errors->any())
            @foreach($errors->all() as $error)
                <p class = "text-danger text-center">{{$error}}</p>
            @endforeach
        @endif
        @if(Session::has('success'))
            <p class = "text-success text-center">{{session('success')}}</p>
        @endif
        @if(Session::has('error'))
            <p class = "text-danger text-center">{{session('error')}}</p>
        @endif
        <div class="row d-flex justify-content-center mt-5">
            <div class="col-lg-7 col-md-12 col-sm-12 mb-3 col-xs-12">
                <div class="card">
                    <h5 class="text-center mb-4">Book your Seva / సేవా కైంకర్యం బుక్ చేసుకోండి. </h5>
<div ><p>కుక్షౌ తిష్ఠతి యస్యాన్నం వేదాభ్యాసేన జీర్యతే, కులం తారయతే తేషాం దశపూర్వం దశాపరమ్ అంటుంది శాస్త్రం. ఎవరి అన్నమైతే వేద విద్యార్థుల జీర్ణకోశంలో జీర్ణమవుతుందో,  ఆ అన్నదానం చేసినవారి వంశం అటు 10 తరాలు, ఇటు 10 తరాలు తరిస్తుందని ధర్మశాస్త్రం తెలియజేస్తుంది.
    ఈ సేవలో .... మీ కటుంబ సభ్యుల  పుట్టిన రోజు గానీ, వివాహ వార్షికోత్సవం రోజు,లేదా  మీ తల్లిదండ్రుల ఆబ్దికం రోజు నాడు గానీ వారి గోత్రం, పేరు వివరాలు చెప్పి వేద విద్యార్థులకు అన్నదానం చేసి మీకు వీడియో పంపించడం జరుగుతుంది.</p></div>
<form method="POST" action="{{route('sevas.store')}}" enctype="multipart/form-data">
    @csrf
    <div class="row justify-content-between text-left">
        <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3">Name<span class="text-danger"> *</span></label> <input type="text" id="fname" name="full_name"   required> </div>
        <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3">Contact Details(Mobile)<span class="text-danger"> *</span></label> <input type="text" id="mob" name="contact_details" placeholder="" required> </div>
    </div>
    <div class="row justify-content-between text-left">
        <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3">Email</label> <input type="email" id="mob" name="email" placeholder="" required> </div>
    </div>

    <div class="row justify-content-end">
        <div class="form-group col-sm-6"> <input type="submit" class="btn-block btn-primary"> </div>
    </div>
</form>
                </div>
            </div>
            <div class ="col-4 col-xs-12">
                <img src="../images/QRcode.jpeg" alt="" srcset="" class="img-fluid" style = "width:400px; height:587px;">
            </div>
        </div>
    </div>
@include('include.footer')

</body>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
function toggleNavbar() {
  const navbarLinks = document.getElementById("navbarLinks");
  navbarLinks.classList.toggle("collapsed");
}
</script>
</html>
