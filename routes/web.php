<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('employeedashboard');
Route::get('/employee/logout', 'Auth\LoginController@employeeLogout')->name('logoutemployee');

Route::prefix('admin')->group(function(){
	Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('adminloginform');
	Route::post('/login', 'Auth\AdminLoginController@doLogin')->name('adminlogin');
	Route::get('/', 'AdminController@index')->name('admindashboard');
	Route::get('/logout', 'Auth\AdminLoginController@logout')->name('logoutadmin');

	Route::get('/employees', 'EmployeeController@showList');
	Route::get('/addemployee', 'EmployeeController@showEmployeeForm');
	Route::post('/addemployee', 'EmployeeController@addNewEmployee');
	Route::get('/editemployee/{id}', 'EmployeeController@editEmployeeForm');
	Route::post('/editemployee/{id}', 'EmployeeController@updateEmployee');
	Route::get('/activateemployee/{id}', 'EmployeeController@activateEmployee');
	Route::get('/deactivateemployee/{id}', 'EmployeeController@deactivateEmployee');

	Route::get('/salary', 'SalaryController@getSalaryDetails');
	Route::post('/salary', 'SalaryController@getSalaryCalculation');
});