@extends('layouts.admin')

@section('head')
    <title>{{ config('app.name', 'EmployeeManagement') }} | Edit Employee Form</title>
@endsection

@section('content')
    <div class = "row" style="margin:15px 0px;">
        <div class = "col-md-12">
            <h3 class="h4 mb-2 text-gray-800">Edit Employee Detail</h3>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">

            {{ Form::open(['name' => 'editemployeeform','file' => true, 'enctype' => 'multipart/form-data', 'id' => 'editemployeeform']) }}

            {{ csrf_field() }}

                <div class="form-group text-center">
                    <b><span class="text-success text-center" id="success-message"> </span><b>
                </div>  

                <div class="form-group row">
                    <div class="col-md-2">
                        <label class="col-md-12 col-form-label">Name</label>
                    </div>
                    <div class="col-md-10">
                        <input type = "text" value="{{$employeedetail->name}}" name="empname" class="form-control" placeholder="Employee Name"/>

                        <span class="text-danger" id="name-err" style="font-size: 14px;"></span>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-2">
                        <label class="col-md-12 col-form-label">Email</label>
                    </div>
                    <div class="col-md-10">
                        <input type = "text" value="{{$employeedetail->email}}" name="empemail" class="form-control" placeholder="Employee Email ID"/>

                        <span class="text-danger" id="email-err" style="font-size: 14px;"></span>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-2">
                        <label class="col-md-12 col-form-label">Mobile Number</label>
                    </div>
                    <div class="col-md-10">
                        <input type = "text" value="{{$employeedetail->mobilenumber}}" onkeypress="return isNumber(event)" name="mobilenumber" class="form-control" placeholder="Employee Mobilenumber"/>

                        <span class="text-danger" id="mobilenumber-err" style="font-size: 14px;"></span>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-2">
                        <label class="col-md-12 col-form-label">Designation</label>
                    </div>
                    <div class="col-md-10">
                        <select class="form-control" name="designation">
                            <option value="">--Select Designation Here--</option>
                            @foreach($designations as $designation)
                                <option value="{{$designation->id}}" @if($employeedetail->designationId == $designation->id) selected @endif>{{$designation->designationname}}</option>
                            @endforeach
                        </select>
                        
                        <span class="text-danger" id="designation-err" style="font-size: 14px;"></span>
                        
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-2">
                        <label class="col-md-12 col-form-label">Salary</label>
                    </div>
                    <div class="col-md-10">
                        <input type = "number" value="{{$employeedetail->salary}}" name="salary" class="form-control" placeholder="Salary"/>

                        <span class="text-danger" id="salary-err" style="font-size: 14px;"></span>
                    </div>
                </div>

                <div class="formbtnarrange">
                    <button class="btn btn-lg btn-primary btn-block btn-login text-uppercase font-weight-bold mb-2" type="submit">Update Employee Detail</button>
                </div>
                
            {{ Form::close() }}
        </div>
    </div>

    <script>
        // ALlow Only number for mobile number
        function isNumber(evt) {
            evt = (evt) ? evt : window.event;
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                return false;
            }
            return true;
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).on('submit','#editemployeeform',function(e){
            
            var form_data = $(this);

            $('#name-err').text('');
            $('#email-err').text('');
            $('#mobilenumber-err').text('');
            $('#designation-err').text('');
            $('#salary-err').text('');
            var empid = {{$employeedetail->id}}
            $.ajax({
                
                url: '{{url('/admin/editemployee')}}/'+empid,
                type: "POST",
                data: form_data.serialize(), 

                success:function(response){
                    console.log(response);
                    if(response) {
                        if(response.empname){
                            $('#name-err').text(response.empname);
                        }
                        if(response.empemail){
                            $('#email-err').text(response.empemail);
                        }
                        if(response.designation){
                            $('#designation-err').text(response.designation);
                        }
                        if(response.mobilenumber){
                            $('#mobilenumber-err').text(response.mobilenumber);
                        }
                        if(response.salary){
                            $('#salary-err').text(response.salary);
                        }
                        if(response.success){
                            $('#success-message').text(response.success).fadeOut(3000);
                            //$("#employeeform")[0].reset();
                        }
                    }
                },
                error: function(response) {
                
                }
            });
            e.preventDefault();
        });
        
    </script>
@endsection

@section('foot')

@endsection