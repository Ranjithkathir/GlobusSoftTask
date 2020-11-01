<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator,Redirect,Response;

class SalaryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * It shows the To get the time file and fixed salary from admin.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getSalaryDetails(){
    	return view('salaryform');
    }

    /**
     * It gives the calculation of given salary input.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getSalaryCalculation(Request $request){

    	$messages = [
    		'required' => 'The :attribute field is required'
    	];

        $validator = validator::make($request->all(), [
             'employeename'  => 'required|string',
             'salary' => 'required|numeric',
        ], $messages);

        if ($validator->fails()) {

        	$response = $validator->messages();

        }else{

        	$correcttime = 0;
        	$overtime = 0;
        	$leave = 0;
        	$bonustime = 0;
        	$totalsalary = 0;
        	$leavelop = 0;
        	$overtimelop = 0;
        	$bonusamnt = 0;

        	if ($request->hasFile('timecsv')) {

        		// File Details
        		$lfiles = $request->file('timecsv');
        		$destinationPath = 'public/uploads/csvuploads/'; // upload path
                $loadedfileName = date('YmdHis') . "." . $lfiles->getClientOriginalExtension();
                $lfiles->move($destinationPath, $loadedfileName);

        		$location = '\uploads\csvuploads';
        		
          		// Import CSV 
		        $filepath = public_path($location."\\".$loadedfileName);
		       
		          // Reading file
		        $file = fopen($filepath,"r");

		        ini_set('auto_detect_line_endings', TRUE);
		        
        		$header = '';
        		$rows = array_map('str_getcsv', file($filepath));
        		$header = array_shift($rows);
        		$csv = array();
        		set_time_limit(0);//reset maximum execution time to infinity for this function

        		foreach ($rows as $row) {
		            //$csv[] =  $row;//Is not used
		            if($row[2] > 0 && $row[2] <= 10){
		            	$correcttime++;
		            }else if($row[2] > 10){
		            	$overtime++;
		            }else if($row[2] == 0 || empty($row[2]) ){
		            	$leave++;
		            }
	        	}
	        	//echo 'correcttime'.$correcttime.'<br/>'.$overtime.'<br/>'.$leave;die();
	        	$enteredsalary = $request->salary;
	        	$overtimelopcount = $overtime/2;
	        	if($correcttime >= 10){
	        		$bonusamntdays = $correcttime % 10;
	        	}else{
	        		$bonusamntdays = 0;
	        	}

	        	$perdaysal = $enteredsalary/count($rows);
	        	$leavelop = $leave * $perdaysal;
	        	$overtimelop = $overtimelopcount * $perdaysal;
	        	$bonusamnt = $bonusamntdays * $perdaysal;

	        	$totalsalary = $totalsalary + ($enteredsalary - $leavelop - $overtimelop) + $bonusamnt;
	        	
	        	if($totalsalary <= 0){
	        		$totalsalary = 0;
	        	}else{
	        		$totalsalary = $totalsalary;
	        	}
        	}


        	
        	$response = ['rows' => count($rows),'success'=>'Salary calulated successfully.', 'givenemployeename' => $request->employeename, 'fixedsalary' => $request->salary, 'totalsalary' => $totalsalary, 'leavelop' => $leavelop, 'overtimelop' => $overtimelop, 'bonusamnt' => $bonusamnt];
        }

        return response()->json($response, 200);
    }
}
