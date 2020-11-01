@extends('layouts.admin')

@section('head')
    <title>{{ config('app.name', 'EmployeeManagement') }} | Employee List</title>
    <link rel="stylesheet" type="text/css" href="{{url('public/assets/css/dataTables.bootstrap4.min.css')}}">
@endsection

@section('content')

<!-- Page Heading -->
    <div class = "row" style="margin:15px 0px;">
        <div class = "col-md-9">
            <h3 class="h4 mb-2 text-gray-800">Employee's Lists</h3>
        </div>
        <div class = "col-md-3">
            <a href="{{url('/admin/addemployee')}}" class="btn btn-success"><i class="fas fa-fw fa-plus"></i> Add New Employee</a>
        </div>
    </div>
    @foreach ($errors->all() as $error)
        <div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>{{ $error }}</div>
    @endforeach
    @if ( session()->has('message') )
        <div class='alert alert-success alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>{{ session()->get('message') }}</div>
    @endif

<!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Employee's List</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                    
                    <div class="">
                        <div class="col-sm-12">
                            <table class="table table-striped table-bordered" id="employeeListTable" width="100%" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Mobile Number</th>
                                        <th>Designation</th>
                                        <th>Salary</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Mobile Number</th>
                                        <th>Designation</th>
                                        <th>Salary</th>
                                        <th>Actions</th>
                                    </tr>
                                </tfoot>
                                <tbody>  
                                @if(count($employeedetails) > 0)
                                @foreach($employeedetails as $employeedetail)          
                                    <tr>
                                        <td>{{$employeedetail['id']}}</td>
                                        <td>{{$employeedetail['name']}}</td>
                                        <td>{{$employeedetail['email']}}</td>
                                        <td>{{$employeedetail['mobilenumber']}}</td>
                                        <td>{{$employeedetail['designation']['designationname']}}</td>
                                        <td>{{$employeedetail['salary']}}</td>
                                        <td class="text-center">
                                            <a class="text-primary" data-toggle="tooltip" data-placement="top" href="{{url('/admin/editemployee')}}/{{base64_encode($employeedetail['id'])}}" data-toggle="tooltip" data-plcement="top" title="Edit" ><i class="fas fa-edit fa-fw" aria-hidden="true"></i> </a>
                                        @if( $employeedetail['isActive'] == 1 )
                                            <a class="text-danger" data-toggle="tooltip" data-placement="top" href="{{url('/admin/deactivateemployee')}}/{{$employeedetail['id']}}" data-toggle="tooltip" data-plcement="top" title="Deactivate" ><i class="fas fa-minus-circle fa-fw" aria-hidden="true"></i> </a>
                                        @else
                                            <a class="text-success" data-toggle="tooltip" data-placement="top" title="Activate" href="{{url('/admin/activateemployee')}}/{{$employeedetail['id']}}" data-toggle="tooltip" data-plcement="top" title="Activate"><i class="fa fa-check-circle fa-fw" aria-hidden="true"></i> </a>
                                        @endif
                                        </td>
                                    </tr>
                                @endforeach  
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
      <!-- Page level plugins -->
  <script src="{{url('public/assets/js/jquery.dataTables.min.js')}}"></script>
  <script src="{{url('public/assets/js/dataTables.bootstrap4.min.js')}}"></script>
  <script src="{{url('public/assets/js/dataTables.buttons.min.js')}}"></script>
  <script src="{{url('public/assets/js/buttons.flash.min.js')}}"></script>
  <script src="{{url('public/assets/js/jszip.min.js')}}"></script>
  <script src="{{url('public/assets/js/pdfmake.min.js')}}"></script>
  <script src="{{url('public/assets/js/vfs_fonts.js')}}"></script>
  <script src="{{url('public/assets/js/buttons.html5.min.js')}}"></script>
  <script src="{{url('public/assets/js/buttons.print.min.js')}}"></script>

  <!-- Page level custom scripts -->
  <script src="{{url('public/assets/js/datatables-custom.js')}}"></script>
  
@endsection

@section('foot')

@endsection