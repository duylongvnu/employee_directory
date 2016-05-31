<?php

namespace App\Http\Controllers\department;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Departments;
use App\Employees;
use DB;

class DepartmentsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['only' => ['create', 'edit', 'destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departments = Departments::all();
        $employees = Employees::all();
        return view("department\home")->with([
            'departments' => $departments,
            'employees' => $employees
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $employees = Employees::all();
        return view("department\add")->with("employees", $employees);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $dulieu_tu_input = new Departments;

        /* Check the name value and the office_phone value */
        $departments = Departments::all();
        foreach ($departments as $department) {
            if ($department->name == $request->Input('name') || $department->office_phone == $request->Input('office_phone')) {
                if ($department->name == $request->Input('name')) {
                    \Session::flash('message1', 'The name has already been taken.');
                }
                if ($department->office_phone == $request->Input('office_phone')) {
                    \Session::flash('message2', 'The Office Phone has already been taken.');
                }
                return redirect('department/add');
            }
        }

        /* Save the information of newly resource */
        $dulieu_tu_input->name = $request->Input('name');
        $dulieu_tu_input->office_phone = $request->Input('office_phone');
        $dulieu_tu_input->manager_id = $request->Input('manager_id');
        $dulieu_tu_input->save();

        /* Show the succesfully announce */
        \Session::flash('message', 'Department have been saved !');
        return redirect('department');
    }

    /**
     * Show the infomation of the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function detail($id){
        $departments = Departments::findOrFail($id);
        if ($departments->manager_id != ""){
            /* Find the employee which have id by departments->manger_id */
            $employee = Employees::findOrFail($departments->manager_id);
            return view('department\detail', compact('departments', 'employee'));
        }
        return view('department\detail', compact('departments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $departments = Departments::findOrFail($id);
        $employees = Employees::all();
        return view('department\edit', compact('departments', 'employees'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        /* Check the name value and the office_phone value */
        $departments = Departments::all();
        foreach ($departments as $department) {
            if ($department->id != $id && ($department->name == $request->Input('name') || $department->office_phone == $request->Input('office_phone'))) {
                if ($department->name == $request->Input('name')) {
                    \Session::flash('message1', 'The name has already been taken.');
                }
                if ($department->office_phone == $request->Input('office_phone')) {
                    \Session::flash('message2', 'The Office Phone has already been taken.');
                }
                return redirect('department/edit/'. $id);
            }
        }

        /* Update the infomation of the specified resource */
        $department = Departments::findOrFail($id);

        $department->name = $request->Input('name');
        $department->office_phone = $request->Input('office_phone');
        $department->manager_id = $request->Input('manager_id');
        $department->update();

        /* Show the editted announce */
        \Session::flash('message', 'Department have been editted !');
        return redirect('department');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $departments = Departments::findOrFail($id);
        $employees = Employees::all();
        /* Find the employees who have department_id by id of the specified resource.
        Then assigns empty value for department_id. */
        foreach ($employees as $employee) {
            if ($employee->department_id == $departments->id) {
                $employee->department_id = "";
                $employee->update();
            }
        }
        $departments->delete();

        /* Show the deleted announce */
        \Session::flash('message', 'Department have been deleted !');
        return redirect()->route('department.index');
    }
}
