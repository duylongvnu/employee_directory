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

        $dulieu_tu_input->name = $request->Input('name');
        $dulieu_tu_input->office_phone = $request->Input('office_phone');
        $dulieu_tu_input->manager_id = $request->Input('manager_id');
        $dulieu_tu_input->save();
        \Session::flash('message1', 'Department have been saved !');
        return redirect('department');
    }

    public function detail($id){
        $departments = Departments::findOrFail($id);
        if ($departments->manager_id != ""){
            $employee = Employees::findOrFail($departments->manager_id);
            return view('department\detail', compact('departments', 'employee'));//->with("employee", $employee);
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
        return view('department\edit', compact('departments', 'employees'));//->with("employees", $employees);
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
        $departments = Departments::findOrFail($id);
        $departments->name = $request->Input('name');
        $departments->office_phone = $request->Input('office_phone');
        $departments->manager_id = $request->Input('manager_id');
        $departments->update();
        \Session::flash('message2', 'Department have been editted !');
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
        foreach ($employees as $employee) {
            if ($employee->department_id == $departments->id) {
                $employee->department_id = "";
                $employee->update();
            }
        }
        $departments->delete();
        \Session::flash('message3', 'Department have been deleted !');
        return redirect()->route('department.index');
    }
}
