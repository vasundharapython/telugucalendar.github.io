<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>HindhuDharmaChakram</title>
    <link rel="stylesheet" href="../css/portal.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css" integrity="sha384-b6lVK+yci+bfDmaY1u0zE8YYJt0TZxLEAFyYSLHId4xoVvsrQu3INevFKo+Xir8e" crossorigin="anonymous">
  <!-- Link to Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Link to Font Awesome CSS -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.20.3/css/all.min.css" rel="stylesheet">
</head>
<body style="font-family: Ramabhadra; font-size: 22px;">
    <div class="google-translator lang" id="google_translate_element"></div>
    @include('include.nav')

  <div class="container-fluid bgred ">
    <div class = "table-responsive">
        <h4 class="text-center text-white mb-4">Job Portal</h4>
    <table class="table table-bordered table-striped table-hover datatable datatable-product bg-white" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Job Category</th>
                <th>Job Profile</th>
                <th>Location</th>
                <th>Job Description</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($application as $key => $apl)
                <tr>
                    <td>{{++$key}}</td>
                    <td>{{$apl->job_category->category}}</td>
                    <td>{{$apl->job_role->job_role}}</td>
                    <td>{{$apl->location}}</td>
                    <td>{{$apl->description}}</td>
                    <td>
                        <a href = "#" data-toggle="modal" data-target="#jobModal{{$apl->id}}" class = "btn btn-success btn-sm">Apply</i></a>
                                    <div class="modal fade" id="jobModal{{$apl->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h4 class="modal-title fs-5" id="exampleModalLabel">Apply</h4>
                                              <button type="button" class="btn btn-close" data-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form  method = "POST" enctype = "multipart/form-data" action = "{{route('portals.update',[$apl->id])}}">
                                                    @csrf
                                                    @method('PUT')
                                                    <label>Name<span class = "text-danger">*</span></label>
                                                    <input name = "name" class = "form-control" required type = "text">
                                                    <label>Phone.No<span class = "text-danger">*</span></label>
                                                    <input name = "phone_no" class = "form-control" required type = "number">
                                                    <label>Email<span class = "text-danger">*</span></label>
                                                    <input name = "email" class = "form-control" required type = "email">
                                                    <label>Attach</label>
                                                    <input name = "file" class = "form-control" type = "file" >
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                    </div>
                                                </form>
                                            </div>
                                          </div>
                                        </div>
                                    </div>
                    </td>
                </tr>
                @endforeach
        </tbody>
    </table>
</div>
<div class = "row">
    <div class="col"></div>
    <div class="col-xs-12">
        <a href = "#" data-toggle="modal" data-target="#jobModal" class = "btn btn-success btn-sm px-5">Submit Your Resume For Job,We Will Call You Back</i></a>
                                    <div class="modal fade" id="jobModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h4 class="modal-title fs-5" id="exampleModalLabel">Apply</h4>
                                              <button type="button" class="btn btn-close" data-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form  method = "POST" enctype = "multipart/form-data" action = "{{route('portals.store')}}">
                                                    @csrf
                                                    <label>Name<span class = "text-danger">*</span></label>
                                                    <input name = "name" class = "form-control" required type = "text">
                                                    <label>Phone.No<span class = "text-danger">*</span></label>
                                                    <input name = "phone_no" class = "form-control" required type = "number">
                                                    <label>Email<span class = "text-danger">*</span></label>
                                                    <input name = "email" class = "form-control" required type = "email">
                                                    <label>Attach</label>
                                                    <input name = "file" class = "form-control" type = "file" >
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                    </div>
                                                </form>
                                            </div>
                                          </div>
                                        </div>
                                    </div>
    </div>
    <div class="col"></div>
</div>

        @include('include.footer')


  </div>




			<!-- loader -->
			@include('include.script')

		</body>
		</html>
