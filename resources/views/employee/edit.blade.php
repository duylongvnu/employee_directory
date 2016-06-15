@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-success">
                <div class="panel-heading">Edit Employee</div>
				<div class="panel-body">
					<div class="form-horizontal">
					{{ Form::model($employees,['method' => 'PATCH', 'action' => ['employee\EmployeesController@update', $employees->id], 'files' => true]) }}

                        <div class="col-md-5">
                            <div class="form-group{{ $errors->has('photo') ? ' has-error' : '' }}">
                                @if ($employees->photo == "")
                                    <img src="{{ asset('image/icon-profile.png') }}" width="250px" height="200px"><br /><br />
                                @else
                                    <img src="{{ asset('image/'. $employees->photo) }}" width="250px" height="200px"><br /><br />
                                @endif
                                <div class="col-md-6">
                                    <input type="file" name="photo" accept="image/*">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-7">
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Name</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="name" value="{{ $employees->name }}">
                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('department') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Department</label>
                                <div class="col-md-6">
                                    <select class="form-control" id="department" name="department">
                                        <option value=""></option>
                                        @foreach ($departments as $department)
                                            @if ($department->id == $employees->department_id)
                                                <option value="{{ $department->id }}" selected="selected">{{ $department->name }}</option>
                                            @else
                                                <option value="{{ $department->id }}">{{ $department->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('job_title') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Job Title</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="job_title" name="job_title" value="{{ $employees->job_title }}">
                                    @if ($errors->has('job_title'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('job_title') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('cellphone') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">CellPhone</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="cellphone" name="cellphone" value="{{ $employees->cellphone }}">
                                    @if ($errors->has('cellphone'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('cellphone') }}</strong>
                                        </span>
                                    @endif
                                    @if(Session::has('message1'))
                                        <span class="help-block">
                                            <strong>{{ Session::get('message1') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Email</label>

                                <div class="col-md-6">
                                    <input type="email" class="form-control" id="email" name="email" value="{{ $employees->email }}">
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                    @if(Session::has('message2'))
                                        <span class="help-block">
                                            <strong>{{ Session::get('message2') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-pencil"></i> Edit Employee
                                </button>
                            </div>
                        </div>
                        
					{{ Form::close() }}
					</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection