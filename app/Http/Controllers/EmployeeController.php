<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;
use App\Designation;
use Validator,Redirect,Response;

class EmployeeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function showList()
    {
    	$employeedetails = Employee::with('designation')->get()->toArray();
    	// echo '<pre>';print_r($employeedetails);exit;
        return view('employeelist')->with('employeedetails', $employeedetails);
    }

    public function showEmployeeForm(){
    	$designations = Designation::all();
    	return view('employeeform')->with('designations', $designations);
    }

    public function addNewEmployee(Request $request){
    	
    	$messages = [
    		'required' => 'The :attribute field is required'
    	];

    	$validator = validator::make($request->all(), [
             'empname'           => 'required|string',
             'empemail'          => 'required|email',
             'designation'        => 'required',
             'mobilenumber'  => 'required|numeric',
             'salary'        => 'required',
        ], $messages);

        if ($validator->fails()) {

        	$response = $validator->messages();

        }else{
        	Employee::create([
	            'name'          => $request->empname,
	            'email'         => $request->empemail,
	            'mobilenumber'  => $request->mobilenumber,
	            'designationId' => $request->designation,
	            'salary'       => $request->salary,
	        ]);
	    	$response = ['success'=>'Employee detail submitted successfully.'];
        }

        return response()->json($response, 200);

    }

    public function editEmployeeForm($id){
    	$id = base64_decode($id);
    	$employeedetail = Employee::find($id);
    	$designations = Designation::all();

    	return view('editemployeeform')->with(compact('employeedetail', 'designations'));
    }

    public function updateEmployee(Request $request,$id){

    	$employeedetail = Employee::find($id);
    	
    	$messages = [
    		'required' => 'The :attribute field is required'
    	];

    	$validator = validator::make($request->all(), [
             'empname'           => 'required|string',
             'empemail'          => 'required|email',
             'designation'        => 'required',
             'mobilenumber'  => 'required|numeric',
             'salary'        => 'required',
        ], $messages);

        if ($validator->fails()) {

        	$response = $validator->messages();

        }else{
            $employeedetail->name = $request->empname;
            $employeedetail->email = $request->empemail;
            $employeedetail->mobilenumber  = $request->mobilenumber;
            $employeedetail->designationId = $request->designation;
            $employeedetail->salary = $request->salary;

            $employeedetail->save();
	        
	    	$response = ['success'=>'Employee detail updated successfully.'];
        }

        return response()->json($response, 200);
    }

    public function activateEmployee($id){
    	$employeedetail = Employee::find($id);

    	if($employeedetail->isActive == 0){
    		$employeedetail->isActive = 1;
    		$employeedetail->save();

    		return redirect('admin/employees')->with('message' , $employeedetail->name.'\'s is Activated Successfully');
    	}
    }

    public function deactivateEmployee($id){
    	$employeedetail = Employee::find($id);
    	if($employeedetail->isActive == 1){
    		$employeedetail->isActive = 0;
    		$employeedetail->save();

    		return redirect('admin/employees')->with('message' , $employeedetail->name.'\'s is Dectivated Successfully');
    	}
    }
}
