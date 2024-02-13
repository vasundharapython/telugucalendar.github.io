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
            <p class = "text-success text-center">{{session('success')}}</p>
        @endif
        @if(Session::has('error'))
            <p class = "text-danger text-center">{{session('error')}}</p>
        @endif
        <div class="row d-flex justify-content-center mt-5">
            <div class="col-lg-7 col-md-12 col-sm-12 mb-3 col-xs-12">
                <div class="card">
                    <h5 class="text-center mb-4">Book Online Puja / ఆన్లైన్ లో పూజ కోసం బుక్ చేసుకోండి.</h5>
                    <div ><p>If you are staying abroad and want to perform your puja, like Satyanarayana Vratam, Varalakshmi Vratam, Rudrabhishekam, Pitru Karyam, Pitru Tarpanam Etc… through online use this service. We will help you with good and experienced Pandit, with hi speed internet Wifi </p></div>
                    <form method="POST" action="{{route('onlinepujas.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="row justify-content-between text-left">
                            <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3">Name<span class="text-danger"> *</span></label> <input type="text" id="fname" name="full_name"   > </div>
                            <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3">Details of Program<span class="text-danger"> *</span></label> <textarea type="text" id="lname" name="program_details" ></textarea> </div>
                        </div>
                        <div class="row justify-content-between text-left">
                            <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3">Place and Country of program<span class="text-danger"> *</span></label> <input type="text" id="lname" name="place_of_program"> </div>
                            <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label ">Date of program<span class="text-danger"> *</span></label> <input type="date" id="address" name="date_time" > </div>
                        </div>
                        <div class="row justify-content-between text-left">
                            <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3">Contact Details(Mobile)<span class="text-danger"> *</span></label> <input type="text" id="mob" name="contact_details" placeholder=""> </div>
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
