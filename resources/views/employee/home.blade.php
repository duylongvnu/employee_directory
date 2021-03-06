@extends('layouts.app')

@section('content')
<div class="container">
	@if(Session::has('message'))
        <div class="alert alert-warning">
            <strong>{{ Session::get('message') }}</strong>
        </div>
    @endif
    
	@if (Auth::user())
        <a href="{{ url('/employee\add') }} " class="btn btn-primary"><i class="fa fa-user-plus"></i> Add Employee</a><br /><br />
    @endif
    
    <div class="panel panel-info">
    	<div class="panel-heading"><strong>Search</strong></div>
    	<div class="panel-body">
    		<form class="form-inline" id="indexForm" method="GET" action="{{ url('/employee') }}" accept-charset="utf-8">

    			<div class="form-group">
    				<label class="sr-only" for="name">Employee Name</label>
    				<input name="name" class="form-control" placeholder="Employee Name" type="text" id="name" value="{{$name}}"/>
    			</div>

    			<div class="form-group">
    				<label class="sr-only" for="department">Department</label>
    				<select class="form-control" id="department" name="department_id">
    					<option value="">Department</option>
    					@foreach ($departments as $department)
    						@if ($department->id == $department_1)
                            	<option value="{{ $department->id }}" selected="selected">{{ $department->name }}</option>
                            @else
                            	<option value="{{ $department->id }}">{{ $department->name }}</option>
                            @endif
                        @endforeach
                    </select>
    			</div>

    			<button class="btn btn-danger" type="submit"><i class="fa fa-search"> Search</i></button>
				<button class="btn btn-warning btn-clear" type="button"><i class="glyphicon glyphicon-erase"> Clear</i></button>
    		</form>
    	</div>
    </div>
    <div class="panel panel-success">
            	
        <div class="panel-heading"><strong>Employees</strong></div>
		<div class="panel-body">
			<?php
				$stt = 1;
			?>
			<table class="table table-striped">
				<tr>
					<th>STT</th>
					<th>Name</th>
					<th>Department</th>
					<th>Job Title</th>
					<th>Email</th>
					@if (Auth::user())
						<th>Action</th>
					@endif
				</tr>
				@foreach($employees as $employee)
					<tr>
						<td>{{ $stt++ }}</td>
						<td><a href="{{ url('/employee/detail', $employee->id) }}"> {{ $employee->name }}</a></td>
						<td>
							@foreach($departments as $department)
								@if ($department->id == $employee->department_id)
									{{ $department->name }}
								@endif
							@endforeach
						</td>
						<td>{{ $employee->job_title }}</td>
						<td>{{ $employee->email }}</td>
						@if (Auth::user())
							<td>
								{{ Form::open(['route' => ['employee.destroy', $employee->id], 'method' => 'delete', 'onsubmit' => 'return ConfirmDelete()']) }}
								<a href="{{ url('/employee/edit', $employee->id) }}" class="btn btn-success"><i class="glyphicon glyphicon-pencil"> Edit</i></a>
								<a href="{{ url('/employee') }}"><button type="submit" class="btn btn-info"><i class="glyphicon glyphicon-trash"> Delete</i></button></a>
								{{ Form::close() }}
							</td>
						@endif
					</tr>
				@endforeach
			</table>
		</div>
	</div>
</div>
@endsection