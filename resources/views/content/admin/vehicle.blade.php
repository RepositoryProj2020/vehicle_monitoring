@extends('apps.app_admin')
@section('content')
    {{-- ----------------------------------------
     Vehicle Records Dashboard
 -------------------------------------- --}}

    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-md-12">
                <div class="d-flex justify-content-between">
                    <h1 class="h3 mb-3"><strong>Vehicle</strong> Records</h1>
                    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal"
                        data-bs-target="#createVehicleModal" style="color:#fff;font-size:17px;font-weight:bold">
                        <img src="https://img.icons8.com/external-anggara-glyph-anggara-putra/25/ffffff/external-edit-basic-ui-anggara-glyph-anggara-putra.png"/> Add another vehicle</button>
                </div>
                <div class="card">
                    <div class="card-body shadow-sm">

                        <table id="example" class="table-striped display" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Vehicle Type</th>
                                    <th>Year Model</th>
                                    <th>Plate#</th>
                                    <th>Company</th>
                                    <th>Department</th>
                                    <th>MV File#</th>
                                    <th>Chasis#</th>
                                    <th>Motor#</th>
                                    <th>Assigned Driver</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($vehicles as $vehicle)
                                    <tr>
                                        <td>{{ $vehicle->vehicle_type }}</td>
                                        <td>{{ $vehicle->vehicle_year_model }}</td>
                                        <td>{{ $vehicle->plate_no }}</td>
                                        <td>{{ $vehicle->company_name }}</td>
                                        <td>{{ $vehicle->department_name }}</td>
                                        <td>{{ $vehicle->mv_file_no }}</td>
                                        <td>{{ $vehicle->chasis_no }}</td>
                                        <td>{{ $vehicle->motor_no }}</td>
                                        <td>{{ $vehicle->driver_id === null ? 'No Driver Assigned' : $vehicle->name }}
                                        </td>
                                        <td>
                                            {{-- <button type="button" class="btn btn-primary"
                                                onclick="onClickVehicleDetail({{ $vehicle->id }})"><i
                                                    class="fas fa-eye"></i> View Details</button> --}}
                                                    <a href="{{route('vehicle.details', $vehicle->id)}}" class="btn btn-primary">
                                                        <i class="fas fa-eye"></i> 
                                                        View Details
                                                    </a>   
                                            @if ($vehicle->driver_id === null)
                                                <button type="button" class="btn btn-danger"
                                                    onclick="onClickAssignedDriver({{ $vehicle->id }})"><i
                                                        class="fas fa-user-edit"></i> Assign Driver</button>
                                            @else
                                                <button type="button" class="btn btn-danger"
                                                    onclick="onClickChangeDriver({{ $vehicle->id }})"><i
                                                        class="fas fa-random"></i> Change Driver</button>
                                            @endif
                                        </td>
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
      Modal for Create New Vehicle
 -------------------------------------- --}}

    <div class="modal fade" id="createVehicleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" style="background-color:#F4F3EF">
                <div class="d-flex justify-content-between p-3" style="background-color: #3B7DDD;">
                    <h5 class="modal-title" id="modal-reservation-title"
                        style="color:#fff;font-size:20px;font-weight:bold">Create Vehicle</h5>
                    <i class="fas fa-times fa-2x" data-bs-dismiss="modal" style="cursor: pointer;color:#fff"></i>
                </div>
                <form id="vehicle-form">
                    @csrf
                    <div class="modal-body">

                        <div class="card shadow" style="border:solid 1px #cfcfcf">
                            <div class="card-body pb-1">

                                <div class="row mb-0">
                                    <div class="col-md-8">
                  
                                        <div class="card  mb-0" style="border:solid 1px #cfcfcf">
                                            <div class="card-body py-2">
                                                <label for="exampleFormControlInput1" class="form-label mb-0"><small>Select Vehicle Conditions:</small> </label>
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="vehicleCondition" value="secondhand" id="vehicleCondition">
                                                            <label class="form-check-label" for="flexRadioDisabled">
                                                                <small> SecondHand Vehicle</small> 
                                                            </label>
                                                          </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="vehicleCondition" value="new" id="vehicleCondition">
                                                            <label class="form-check-label" for="flexRadioDisabled">
                                                              <small>New Vehicle</small> 
                                                            </label>
                                                          </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-0">
                                    <div class="col-md-4">
                                        <div class="mb-0">
                                            <label for="exampleFormControlInput1" class="form-label mb-0"><small>Vehicle Type:</small> </label>
                                                    <input type="text" class="form-control" value="" name="vehicleType"
                                                id="vehicleType">
                                        </div>
                                    </div>

                            
                                    <div class="col-md-4">
                                        <div class="mb-0">
                                            <label for="exampleFormControlInput1" class="form-label mb-0"><small>Year
                                                    Model:</small> </label>
                                            <input type="text" class="form-control" value="" name="vehicleModel"
                                                id="vehicleModel">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-0">
                                            <label for="exampleFormControlInput1"
                                                class="form-label mb-0"><small>Plate#:</small> </label>
                                            <input type="text" class="form-control" value="" name="vehiclePlate"
                                                id="vehiclePlate">
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-0">
                                    <div class="col-md-4">
                                        <div class="mb-0">
                                            <label for="exampleFormControlInput1" class="form-label mb-0"><small>MV
                                                    File#:</small> </label>
                                            <input type="text" class="form-control" value="" name="vehicleMV"
                                                id="vehicleMV">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-0">
                                            <label for="exampleFormControlInput1"
                                                class="form-label mb-0"><small>Motor#:</small> </label>
                                            <input type="text" class="form-control" value="" name="vehicleMotor"
                                                id="vehicleMotor">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-0">
                                            <label for="exampleFormControlInput1"
                                                class="form-label mb-0"><small>Chasis#:</small> </label>
                                            <input type="text" class="form-control" value="" name="vehicleChasis"
                                                id="vehicleChasis">
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-0">
                                    <div class="col-md-6">
                                        <div class="mb-0">
                                            <label for="exampleFormControlInput1"
                                                class="form-label mb-0"><small>Company:</small> </label>
                                            <select class="form-select" id="selectedCompany" name="vehicle_company"
                                                aria-label="Default select example">
                                                <option selected disabled>Select Company</option>
                                                @foreach ($companies as $company)
                                                    <option value={{ $company->id }}>{{ $company->company_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-0">
                                            <label for="exampleFormControlInput1"
                                                class="form-label mb-0"><small>Department:</small> </label>
                                            <select class="form-select" id="selectedDepartment"
                                                name="vehicle_department" aria-label="Default select example">
                                                <option selected disabled>Select Department</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-0">
                                    <div class="col-md-6">
                                        <div class="mb-0">
                                            <label for="exampleFormControlInput1" class="form-label mb-0"><small>Tire
                                                    Name:</small> </label>
                                            <input type="text" class="form-control" value="" name="vehicleTire"
                                                id="vehicleTire">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-0">
                                            <label for="exampleFormControlInput1" class="form-label mb-0"><small>Date of
                                                    Purchase Tire:</small> </label>
                                            <input type="date" class="form-control" value="" name="vehicleTirePurchase"
                                                id="vehicleTirePurchase">
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-0">
                                    <div class="col-md-6">
                                        <div class="mb-0">
                                            <label for="exampleFormControlInput1" class="form-label mb-0"><small>Battery
                                                    Name:</small> </label>
                                            <input type="text" class="form-control" value="" name="vehicleBattery"
                                                id="vehicleBattery">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-0">
                                            <label for="exampleFormControlInput1" class="form-label mb-0"><small>Date of
                                                    Purchase Battery:</small> </label>
                                            <input type="date" class="form-control" value=""
                                                name="vehicleBatteryPurchase" id="vehicleBatteryPurchase">
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <div class="col-md-4">
                                        <div class="mb-0">
                                            <label for="exampleFormControlInput1" class="form-label mb-0"><small>Current
                                                    Odo:</small> </label>
                                            <input type="text" class="form-control" value="" name="vehicleOdo"
                                                id="vehicleOdo">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-0">
                                            <label for="exampleFormControlInput1" class="form-label mb-0"><small>Date Of
                                                    Last PMS:</small> </label>
                                            <input type="date" class="form-control" value="" name="vehicleLastPMS"
                                                id="vehicleLastPMS">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-0">
                                            <label for="exampleFormControlInput1"
                                                class="form-label mb-0"><small>Registration Date:</small> </label>
                                            <input type="date" class="form-control" value="" name="vehicleRegDate"
                                                id="vehicleRegDate">
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-0">
                                    <label for="exampleFormControlInput1" class="form-label mb-0"><small>Upload Vehicle
                                            Image:</small> </label>
                                    <input type="file filepond" name="file" id="uploadVehicleImage">
                                </div>

                                <div class="d-grid gap-2">
                                    <button type="submit" id="submitVehicleInfo" class="btn btn-primary mb-3"> Submit
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

{{-- ----------------------------------------
ASSIGN DRIVER VEHICLE MODAL
 -------------------------------------- --}}
    <div class="modal fade" id="assignedDriver" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" style="background-color:#F4F3EF">
                <div class="d-flex justify-content-between p-3" style="background-color: #3B7DDD;">
                    <h5 class="modal-title" id="modal-reservation-title"
                        style="color:#fff;font-size:20px;font-weight:bold">Assigned Driver</h5>
                    <i class="fas fa-times fa-2x" data-bs-dismiss="modal" style="cursor: pointer;color:#fff"></i>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                   
                        <p class="mb-0" id="vehicleTypeTemp" style="font-size:20px;"></p>
                        <p> Plate#: <span id="vehiclePlateNo"></span></p>
                        <label for="exampleFormControlInput1" class="form-label mb-0"><small> Available Drivers:</small>
                        </label>
                        <select class="form-select" id="selectedDriver" name="vehicle_driver"
                            aria-label="Default select example">
                            <option selected disabled>Select Driver</option>
                            @foreach ($drivers as $driver)
                                <option value={{ $driver->id }}>{{ $driver->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="d-grid gap-2">
                        <button type="button" id="submitDriverAssigned" class="btn btn-primary mb-3"> Assigned Driver
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>


{{-- ----------------------------------------
CHANGE DRIVER VEHICLE MODAL
 --------------------------------------- --}}
    <div class="modal fade" id="changeDriver" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" style="background-color:#F4F3EF">
                <div class="d-flex justify-content-between p-3" style="background-color: #3B7DDD;">
                    <h5 class="modal-title" id="modal-reservation-title"
                        style="color:#fff;font-size:20px;font-weight:bold">Change Driver</h5>
                    <i class="fas fa-times fa-2x" data-bs-dismiss="modal" style="cursor: pointer;color:#fff"></i>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <p class="mb-0" id="vehicleTypeTemp" style="font-size:20px;"></p>
                         <p> Plate#: <span id="vehiclePlateNo"></span></p>
                        <label for="exampleFormControlInput1" class="form-label mb-0"><small>Available
                                Drivers:</small> </label>
                        <select class="form-select" id="selectedChangeDriver" name="vehicle_change_driver"
                            aria-label="Default select example">
                            <option selected disabled>
                                {{ count($drivers) > 0 ? 'Select Driver' : 'No Drivers available' }}</option>
                            @foreach ($drivers as $driver)
                                <option value={{ $driver->id }}>{{ $driver->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="d-grid gap-2">
                        <button type="button" id="submitChangeDriver" class="btn btn-primary mb-3"> Changed Driver
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>




    
@endsection
@section('script')
    <script>
        //ONCHANGE FUNCTION OF COMPANY TO SHOW HIS DEPARTMENT
        $('#selectedCompany').on('change', () => {
            var vehicleCompanyId = $('#selectedCompany').val();
            axios.get('/vehicle/company/' + vehicleCompanyId)
                .then(function(response) {
                    $('#selectedDepartment').empty();
                    $('#selectedDepartment').append('<option selected disabled>Select Department</option>');
                    response.data.forEach(value => {
                        $('#selectedDepartment').append('<option value=' + value.id + '>' + value
                            .department_name + '</option>')
                    });
                })
                .catch(function(error) {
                    console.log(error);
                })
        })

        //FILE UPLOAD USING FILEPOND JS
        var pond = FilePond.create(document.getElementById("uploadVehicleImage"), {
            acceptedFileTypes: ['image/*'],
            maxFileSize: "40",
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

        //SUBMIT FUNCTION TO CREATE ANOTHER VEHICLE
        $('#vehicle-form').on('submit', (e) => {
            e.preventDefault();

            var swal = Swal.fire({
                title: 'Please Wait',
                text: 'Saving New Vehicle in database ...',
                icon: 'info',
                allowOutsideClick: false,
                showCancelButton: false,
                showConfirmButton: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            var data = $('#vehicle-form').serializeArray();
            $.ajax({
                type: "POST",
                url: "{{ route('create.vehicle') }}",
                data: data,
                success: function(response) {
                    console.log(response);
                    // location.reload();
                    $('#createVehicleModal').modal('hide');
                    if (response.status == 'ERROR') {
                        Swal.fire({
                            title: 'Error',
                            text: response.message,
                            icon: 'error'
                        });
                    } else if (response.status == "WARNING") {
                        Swal.fire({
                            title: 'Warning',
                            text: response.message,
                            icon: 'warning'
                        });
                    } else if (response.status == "OK") {
                        Swal.fire({
                            title: 'Success',
                            text: response.message,
                            icon: 'success'
                        }).then((result) => {
                            view_request();
                        })
                    }
                }
            });
        });

        //GET ID OF VEHICLE TO ASSIGNED VEHICLE DRIVE
        const onClickAssignedDriver = (id) => {
            axios.get('/vehicle/assign-driver/'+id)
                .then(function(response) {
                    response.data.forEach(value => {
                        console.log(value);
                        $('#vehicleTypeTemp').text(value.vehicle_type);
                        $('#vehiclePlateNo').text(value.plate_no);
                    });
                })
                .catch(function(error) {
                    console.log(error);
                })
            $('#assignedDriver').modal('show');
        }

          //GET ID OF VEHICLE TO ASSIGNED VEHICLE DRIVE
        const onClickChangeDriver = (id) => {
            axios.get('/vehicle/assign-driver/'+id)
                .then(function(response) {
                    response.data.forEach(value => {
                        console.log(value);
                        $('#vehicleTypeTemp').text(value.vehicle_type);
                        $('#vehiclePlateNo').text(value.plate_no);
                    });
                })
                .catch(function(error) {
                    console.log(error);
                })
            $('#changeDriver').modal('show');
        }

        //SUBMIT FUNCTION TO CHANGE DRIVER
        $('#submitChangeDriver').on('click', () => {
            var selectedChangeDriverId = $('#selectedChangeDriver').val();
            var changeVehicleDriver = $('#changeVehicleDriverId').val();
            var swal = Swal.fire({
                title: 'Please Wait',
                text: 'Changed Driver to Vehicle ...',
                icon: 'info',
                allowOutsideClick: false,
                showCancelButton: false,
                showConfirmButton: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            $.ajax({
                type: "POST",
                url: "{{ route('change.vehicle.driver') }}",
                data: {
                    '_token': "{{ csrf_token() }}",
                    'driver_id': selectedChangeDriverId,
                    'vehicle_id': changeVehicleDriver
                },
                success: function(response) {
                    location.reload();
                    $('#assignedDriver').modal('hide');
                    if (response.status == 'ERROR') {
                        Swal.fire({
                            title: 'Error',
                            text: response.message,
                            icon: 'error'
                        });
                    } else if (response.status == "WARNING") {
                        Swal.fire({
                            title: 'Warning',
                            text: response.message,
                            icon: 'warning'
                        });
                    } else if (response.status == "OK") {
                        Swal.fire({
                            title: 'Success',
                            text: response.message,
                            icon: 'success'
                        }).then((result) => {
                            view_request();
                        })
                    }

                }
            });
        })

        //SUBMIT FUNCTION TO ASSIGNED DRIVER
        $('#submitDriverAssigned').on('click', () => {
            var selectedDriverId = $('#selectedDriver').val();
            var vehicleId = $('#vehicleId').val();
            var swal = Swal.fire({
                title: 'Please Wait',
                text: 'Assigned Driver to Vehicle ...',
                icon: 'info',
                allowOutsideClick: false,
                showCancelButton: false,
                showConfirmButton: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            $.ajax({
                type: "POST",
                url: "{{ route('update.vehicle.driver') }}",
                data: {
                    '_token': "{{ csrf_token() }}",
                    'driver_id': selectedDriverId,
                    'vehicle_id': vehicleId
                },
                success: function(response) {
                    location.reload();
                    $('#assignedDriver').modal('hide');
                    if (response.status == 'ERROR') {
                        Swal.fire({
                            title: 'Error',
                            text: response.message,
                            icon: 'error'
                        });
                    } else if (response.status == "WARNING") {
                        Swal.fire({
                            title: 'Warning',
                            text: response.message,
                            icon: 'warning'
                        });
                    } else if (response.status == "OK") {
                        Swal.fire({
                            title: 'Success',
                            text: response.message,
                            icon: 'success'
                        }).then((result) => {
                            view_request();
                        })
                    }

                }
            });
        })




     
    </script>
@endsection
