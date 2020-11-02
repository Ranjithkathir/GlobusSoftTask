@extends('layouts.admin')

@section('head')
    <title>{{ config('app.name', 'EmployeeManagement') }} | Employee Form</title>
    <meta charset="UTF-8">
@endsection

@section('content')
    <div class = "row" style="margin:15px 0px;">
        <div class = "col-md-12">
            <h3 class="h4 mb-2 text-gray-800">Salary Form</h3>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">

            {{ Form::open(['name' => 'salaryform','file' => true, 'enctype' => 'multipart/form-data', 'id' => 'salaryform']) }}

            {{ csrf_field() }}

                <div class="form-group text-center">
                    <b><span class="text-success text-center" id="success-message"> </span><b>
                </div>

                <div class="form-group row">
                    <div class="col-md-2">
                        <label class="col-md-12 col-form-label">Name</label>
                    </div>
                    <div class="col-md-10">
                        <input type = "text" value="{{old('employeename')}}" name="employeename" class="form-control" placeholder="Employee Name"/>

                        <span class="text-danger" id="name-err" style="font-size: 14px;"></span>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-2">
                        <label class="col-md-12 col-form-label">Enter Salary</label>
                    </div>
                    <div class="col-md-10">
                        <input type = "number" value="{{old('salary')}}" name="salary" class="form-control" placeholder="Enter Fixed Salary"/>

                        <span class="text-danger" id="salary-err" style="font-size: 14px;"></span>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-2">
                        <label class="col-md-12 col-form-label">Upload time CSV</label>
                    </div>
                    <div class="col-md-10">
                        <input type = "file" name="timecsv" />

                        <span class="text-danger" id="csv-err" style="font-size: 14px;"></span>
                    </div>
                </div>

                <div class="formbtnarrange">
                    <button class="btn btn-lg btn-primary btn-block btn-login text-uppercase font-weight-bold mb-2" type="submit">Lets Calculate</button>
                </div>
                
            {{ Form::close() }}

            <div class="col-md-12">
                <div class="salcalarea" id="fixed-sal"></div>
            </div>
        </div>
    </div>

    <script>

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).on('submit','#salaryform',function(e){
            
            var form_data = $(this);

            $('#name-err').text('');
            $('#salary-err').text('');
            $('#csv-err').text('');
            $('#fixed-sal').text('');

            $.ajax({
                url: '{{url('/admin/salary')}}',
                type: "POST",
                dataType: "JSON",
                data: new FormData(this),
                processData: false,
                contentType: false,

                success:function(response){
                    console.log(response);
                    if(response) {
                        if(response.employeename){
                            $('#name-err').text(response.employeename);
                        }
                        if(response.salary){
                            $('#salary-err').text(response.salary);
                        }
                        if(response.timecsv){
                            $('#csv-err').text(response.timecsv);
                        }
                        if(response.success){
                            $('#success-message').text(response.success).fadeOut(5000);
                            $("#salaryform")[0].reset();
                        }
                        if(response.rows){
                            $('#fixed-sal').html('<div><p>The Salary slip of '+response.givenemployeename+' is :</p><table><tr><td class="text-success">The Fixed Amount is Rs.'+response.fixedsalary+'</td></tr><tr><td class="text-success">The Salary credited is Rs.'+response.totalsalary+'</td></tr><tr><td class="text-danger">The Salary debited due to leave is Rs.'+response.leavelop+'</td></tr><tr><td class="text-danger">The Salary debited due to overtime late entry is Rs.'+response.overtimelop+'</td></tr><tr><td class="text-success">The Salary credited due to ontime puntual is Rs.'+response.bonusamnt+'</td></tr></table></div>');
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