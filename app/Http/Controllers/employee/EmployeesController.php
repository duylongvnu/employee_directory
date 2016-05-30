<?php

namespace App\Http\Controllers\employee;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Employees;
use App\Departments;
use DB;

class EmployeesController extends Controller
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
        $name = \Request::get('name');
        $department_1 = \Request::get('department_id');
        if ($name || $department_1) {
            if ($department_1 != "" && $name != "") {
                $employees = DB::table('employees')->where('department_id', '=', $department_1)->where('name', 'LIKE', '%'.$name.'%')->get();
            }
            else if ($department_1 == "") {
                $employees = DB::table('employees')->where('name', 'LIKE', '%'.$name.'%')->get();
            }
            else {
                $employees = DB::table('employees')->where('department_id', '=', $department_1)->get();
            }
        }
        else{
            $department_1 = "";
            $name = "";
        }
        return view("employee\home")->with([
            'employees' => $employees,
            'departments' => $departments,
            'department_1' => $department_1,
            'name' => $name
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departments = Departments::all();
        return view("employee\add")->with("departments", $departments);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dulieu_tu_input = new Employees;
        $logo = $request->file('photo');
        if ($logo != "") {
            $filename = $logo->getClientOriginalName();
            $success = $logo->move('image', $filename);
            $dulieu_tu_input->photo = $filename;
        }
        
        $dulieu_tu_input->name = $request->Input('name');
        $dulieu_tu_input->department_id = $request->Input('department');
        $dulieu_tu_input->job_title = $request->Input('job_title');
        $dulieu_tu_input->cellphone = $request->Input('cellphone');
        $dulieu_tu_input->email = $request->Input('email');
        $dulieu_tu_input->save();
        \Session::flash('message1', 'Employee have been saved !');
        return redirect('employee');
    }

    public function detail($id){
        $employees = Employees::findOrFail($id);
        if ($employees->department_id != ""){
            $department = Departments::findOrFail($employees->department_id);
            return view('employee\detail', compact('employees'))->with("department", $department);
        }
        return view('employee\detail', compact('employees'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employees = Employees::findOrFail($id);
        $departments = Departments::all();
        return view('employee\edit', compact('employees'))->with("departments", $departments);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $employees = Employees::findOrFail($id);
        $logo = $request->file('photo');
        if ($logo != "") {
            $filename = $logo->getClientOriginalName();
            $success = $logo->move('image', $filename);
            $employees->photo = $filename;
        }

        $employees->name = $request->Input('name');
        $employees->department_id = $request->Input('department');
        $employees->job_title = $request->Input('job_title');
        $employees->cellphone = $request->Input('cellphone');
        $employees->email = $request->Input('email');

        $employees->update();
        \Session::flash('message2', 'Element have been editted !');
        return redirect('employee');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employees = Employees::findOrFail($id);
        $departments = Departments::all();
        
        foreach ($departments as $department) {
            if ($department->manager_id == $employees->id) {
                $department->manager_id = "";
                $department->update();
            }
        }
        $employees->delete();
        \Session::flash('message3', 'Employee have been deleted !');
        return redirect()->route('employee.index');
    }
}
