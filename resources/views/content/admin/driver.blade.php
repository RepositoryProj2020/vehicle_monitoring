@extends('apps.app_admin')
@section('content')
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-md-12">

                <div class="d-flex justify-content-between">
                    <h1 class="h3 mb-3"><strong>Vehicle Drivers</strong> Records</h1>
                    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" style="color:#fff;font-size:17px;font-weight:bold"
                        data-bs-target="#exampleModal"><i class="fas fa-edit"></i> Create Driver</button>
                </div>

                <div class="card">
                    <div class="card-body shadow-sm">
                        <table id="example" class="table-striped display" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Driver Name</th>
                                    <th>Driver Contact</th>
                                    <th>Driver Address</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                              @foreach ($drivers as $driver)
                                <tr>
                                    <td>{{$driver->driver_name}}</td>
                                    <td>{{$driver->driver_contact}}</td>
                                    <td>{{$driver->driver_address}}</td>
                                  @if ($driver->status == 'assigned')
                                        <td><span class="badge bg-danger">{{$driver->status}}</span> </td>
                                     @else
                                        <td><span class="badge bg-success">{{$driver->status}}</span> </td>
                                  @endif
                              </tr>
                              @endforeach
                            
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


{{-- ----------------------------------------
 Modal for Reservation Details
 -------------------------------------- --}}

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" style="background-color: #F4F3EF">
          
                    <div class="d-flex justify-content-between p-3"  style="background-color: #3B7DDD;">
                        <h5 class="modal-title" id="modal-reservation-title" style="color:#fff;font-size:20px;font-weight:bold">Create Driver</h5>
                        <i class="fas fa-times fa-2x" data-bs-dismiss="modal" style="cursor: pointer;color:#fff"></i>
                    </div>
    
                <div class="modal-body">
                  <form>
                    <div class="card shadow" style="border:solid 1px #cfcfcf">
                        <div class="card-body">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-0">
                                            <label for="exampleFormControlInput1" class="form-label mb-0"><small>Upload Profile Picture:</small> </label>
                                            <input type="file filepond" name="file" id="uploadProfileImage">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-0">
                                            <label for="exampleFormControlInput1" class="form-label mb-0"><small>ID#</small> </label>
                                            <input type="text" class="form-control" name="vehicle_driver" id="driver_name">
                                        </div>
                                        <div class="mb-0">
                                            <label for="exampleFormControlInput1" class="form-label mb-0"><small>Driver Name</small> </label>
                                            <input type="text" class="form-control" name="vehicle_driver" id="driver_name">
                                        </div>
                                        <div class="mb-0">
                                            <label for="exampleFormControlInput1" class="form-label mb-0"><small>License Exp Date</small> </label>
                                            <input type="date" class="form-control" name="driver_contact" id="contact">
                                        </div>
                                        <div class="mb-0">
                                            <label for="exampleFormControlInput1" class="form-label mb-0"><small>License Type</small> </label>
                                            <select class="form-select" id="selectedDriverLicense" name="driver_license">
                                                <option selected disabled>Select Driver License</option>
                                                <option>Non Pro Driver Lisence </option>
                                                <option>Pro Driver Lisence </option>
                                             </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="exampleFormControlInput1" class="form-label mb-0"><small>License Restriction</small> </label>
                                            <select class="form-select" id="selectedLicenseRestriction" name="driver_license_restriction">
                                                <option selected disabled>Select License Restriction</option>
                                                <option>A - Motorcycle</option>
                                                <option>A1 - Tricycle</option>
                                                <option>B - Vehicles up to 5,000 kgs. GVW/8 seats</option>
                                                <option>B1 - Vehicles up to 5,000 kgs. GVW/9 or more seats</option>
                                                <option>B2 - Vehicles carrying goods ≤ 3,500 kgs GVW</option>
                                                <option>C - Vehicles carrying goods >3,500 kgs GVW</option>
                                                <option>D - Bus > 5,000 kgs GVW/9 or more seats</option>
                                                <option>BE – Trailers ≤ 3,500 kgs</option>
                                                <option>CE - Articulated C > 3,500 kgs combined GVW</option>
                                             </select>
                                        </div>
                                        <div class="mb-0">
                                            <label for="exampleFormControlInput1" class="form-label mb-0"><small>Upload License Image:</small> </label>
                                            <input type="file filepond" name="file" id="uploadLincenseImage">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-grid gap-2">
                                <button type="button" id="submitDriverInfo" class="btn btn-primary mb-3"> Submit </button>
                            </div>
                        </div>
                    </div>
                  </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>   
                FilePond.registerPlugin(
                FilePondPluginImageExifOrientation,
                FilePondPluginFileValidateSize,
                FilePondPluginFileValidateType,
                FilePondPluginImagePreview
            );
        var pond = FilePond.create(document.getElementById("uploadLincenseImage"), {
            acceptedFileTypes: ['image/*'],
            maxFileSize: "40mb",
            maxFiles: "1",
            server: {
                process: {
                    url: "/vehicle/upload-image",
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    },
                },
                revert: {
                    url: "/vehicle/revert-image",
                    method: "DELETE",
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    },
                    onload: function(x) {},
                },
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
            },
            onwarning(error) {
                if (error.code == 0) {
                    Swal.fire({
                        title: "Warning",
                        text: "You can only upload 1 Excel File.",
                        icon: "warning",
                        showCancelButton: false,
                        confirmButtonColor: "#3085d6",
                        confirmButtonText: "Ok.",
                    });
                }
            },
        });



        var pond = FilePond.create(document.getElementById("uploadProfileImage"), {
            acceptedFileTypes: ['image/*'],
            maxFileSize: "40mb",
            maxFiles: "1",
            server: {
                process: {
                    url: "/vehicle/upload-image",
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    },
                },
                revert: {
                    url: "/vehicle/revert-image",
                    method: "DELETE",
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    },
                    onload: function(x) {},
                },
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
            },
            onwarning(error) {
                if (error.code == 0) {
                    Swal.fire({
                        title: "Warning",
                        text: "You can only upload 1 Excel File.",
                        icon: "warning",
                        showCancelButton: false,
                        confirmButtonColor: "#3085d6",
                        confirmButtonText: "Ok.",
                    });
                }
            },
        });

     $('#submitDriverInfo').on('click', ()=> {
        var swal = Swal.fire({
            title:'Please Wait',
            text: 'Saving New Driver in database ...',
            icon: 'info',
            allowOutsideClick: false,
            showCancelButton: false,
            showConfirmButton: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        var driverObjTemp = [];
        var driver_info = {
            "driverName" : $('#driver_name').val(),
            "driverContact" :  $('#contact').val(),
            "driverAddress" : $('#address').val()
        }
        driverObjTemp.push(driver_info);
        $.ajax({
            type : "POST",
            url : "{{route('create.driver')}}",
            data: {
                '_token' : "{{csrf_token()}}",
                'driver_info' : driverObjTemp
            },
            success : function(response){
              swal.close();
              location.reload();
              $('#exampleModal').modal('hide');  
              if (response.status == 'ERROR') {
                  Swal.fire({
                      title:'Error',
                      text: response.message,
                      icon: 'error'
                  });
              }
              else if(response.status == "WARNING") {
                  Swal.fire({
                      title:'Warning',
                      text: response.message,
                      icon: 'warning'
                  });
              }
              else if(response.status == "OK"){
                  
                  Swal.fire({
                      title: 'Success',
                      text: response.message,
                      icon: 'success'
                  }).then( (result) => {
                      view_request(mrid);
                  })
              }
            }
        });
    })



    </script>
@endsection