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

@include('include.nav')
@include('include.service_nav')


    <div class="container-fluid px-1 box12">
        @if($errors->any())
            @foreach($errors->all() as $error)
                <p class = "text-danger">{{$error}}</p>
            @endforeach
        @endif
        @if(Session::has('success'))
            <h6 class = "text-success text-center">{{session('success')}}</h6>
        @endif
        <div class="row d-flex justify-content-center mt-5">
            <div class="col-lg-7 col-md-12 col-sm-12 mb-3 col-xs-12">
                <div class="card">
                    <h5 class="text-center mb-4"><b>వేద విద్యార్థులకు అన్నదానం</b></h5>
                    <div >
                        <p>కుక్షౌ తిష్ఠతి యస్యాన్నం వేదాభ్యాసేన జీర్యతే|</p>
                        <p>కులం తారయతి తేషాం దశ పూర్వం దశా పరమ్||</p>
                        <br>
                        <p>యే గృహస్థు పెట్టిన అన్నము వేదాభ్యాసము చేసే వాని కడుపునపడి వేదాభ్యాసముతో జీర్ణమగునో ఆ అన్నము- ఆ గృహస్థుని,అతని పదితరముల పూర్వులను,పదితరముల(తరువాత వారిని) సంతతిని కూడా తరింపజేయును..</p>
                        <br>
                        <p>మీ ఇంట్లో ఏ శుభకార్యమైనా, జన్మదినం, పెళ్లిరోజు, పితృ కార్యము లేదా మరేదైనా సందర్భం ఉంటే ఆ రోజున మీరు కోరుకున్నవారి పేరు మీద అభిషేకం, అర్చన, ఆయుష్య హోమం, వేద విద్యార్థులకు భోజనం ఏర్పాటు చేసి ఆ వీడియో మీకు పంపించడం జరుగుతుంది.</p>
                    </div>
                    <form method="POST" action="{{route('annadanam.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="row justify-content-between text-left">
                            <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3">Occasion<span class="text-danger"> *</span></label> <input type="text" id="fname" name="occasion"   required> </div>
                            <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3">Name<span class="text-danger"> *</span></label> <input type="text" id="fname" name="full_name"   required> </div>
                            <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3">Gotram<span class="text-danger"> *</span></label> <input type="text" id="fname" name="gotram"   required> </div>
                            <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3">Star<span class="text-danger"> *</span></label> <input type="text" id="fname" name="star"   required> </div>
                            <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3">Residence<span class="text-danger"> *</span></label> <textarea type="text" id="fname" name="residence"   required></textarea> </div>
                            <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3">Contact Details(Mobile)<span class="text-danger"> *</span></label> <input type="text" id="mob" name="contact_details" placeholder="" required> </div>
                            <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3">Date<span class="text-danger"> *</span></label> <input type="date" id="mob" name="date" placeholder=""> </div>
                            <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3">Email</label> <input type="email" id="mob" name="email" placeholder=""> </div>
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
