<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(['middleware' => ['web']], function () {

    Route::get('/', function () {
        return view('welcome');
    });

});

Route::group(['middleware' => 'web'], function () {
    Route::auth();

    Route::resource('/changepassword','UsersController');
    Route::get('/addadmin', 'UsersController@getAdd');
    Route::post('addadmin', 'UsersController@postAdd');
    
    Route::get('/department/detail/{department}', 'department\DepartmentsController@detail');
    Route::get('/department/add', 'department\DepartmentsController@create');
    Route::get('/department/edit/{department}', 'department\DepartmentsController@edit');
    Route::resource('department', 'department\DepartmentsController', ['except' => ['show']]);

    Route::get('/employee/add', 'employee\EmployeesController@create');
    Route::get('/employee/detail/{employee}', 'employee\EmployeesController@detail');
    Route::get('/employee/edit/{employee}', 'employee\EmployeesController@edit');
    Route::resource('employee', 'employee\EmployeesController', ['except' => ['show']]);
});

