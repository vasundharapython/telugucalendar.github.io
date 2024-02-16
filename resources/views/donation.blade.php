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
                <p class = "text-danger">{{$error}}</p>
            @endforeach
        @endif
        @if(Session::has('success'))
            <h6 class = "text-success text-center">{{session('success')}}</h6>
        @endif
        <div class="row d-flex justify-content-center mt-5">
            <div class="col-lg-7 col-md-12 col-sm-12 mb-3 col-xs-12">
                <div class="card">
                    <h5 class="text-center mb-4">Donations /  విరాళాలు</h5>
                    <div ><p>మా సంస్థ ఆధ్వర్యంలో వేద పాతశాలల పోషణ, నిరుపేదలకు మరియు నిరుపేద బ్రాహ్మణులకు ఆర్ధిక సహాయం, జీర్ణమైన ఆలయాల పునరుద్ధరణ, లోక కళ్యాణం కోసం యజ్ఞములు, ధర్మ స్థాపన కోసం ప్రముఖ ప్రవచన కర్తలతో ప్రవచనాలు, విపత్కర పరిస్థితులలో ప్రజలకు మరియు ప్రభుత్వానికి ఆర్ధిక సహకారం, హిందూ క్యాలెండర్ ముద్రణ, ఆధ్యాత్మిక గ్రంధాల ముద్రణ వంటి కార్యక్రమాలు ఆచరిసున్నాము. ఈ సేవలు నిరంతరం సాగడానికి మీ వంతు ఆర్ధిక సహాయం చేసి వేద మాత అనుగ్రహం పొందండి.</p></div>
                    <div>
                        <h5>Bank Details</h5>
                    </div>
                    <div class = "d-flex justify-content-start align-items-center">
                        <h6><b>Account.No:</b></h6> <h6>50200082641402</h6>
                    </div>
                    <div class = "d-flex justify-content-start align-items-center">
                        <h6><b>Bank:</b></h6> <h6>HDFC BANK</h6>
                    </div>
                    <div class = "d-flex justify-content-start align-items-center">
                        <h6><b>Branch:</b></h6> <h6>MALLAPUR Branch</h6>
                    </div>
                    <div class = "d-flex justify-content-start align-items-center">
                        <h6><b>IFSC:</b></h6> <h6>HDFC0004924</h6>
                    </div>
                    <form method="POST" action="{{route('donations.store')}}" enctype="multipart/form-data">
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
