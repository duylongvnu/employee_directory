@extends('layouts.app')

@section('content')
<div class="container">
	@if(Session::has('message'))
        <div class="alert alert-warning">
            <strong>{{ Session::get('message') }}</strong>
        </div>
    @endif

	@if (Auth::user())
        <a href="{{ url('/department\add') }} " class="btn btn-primary"><i class="glyphicon glyphicon-plus-sign"></i> Add Department</a><br /><br />
    @endif

    <div class="panel panel-success">
            	
        <div class="panel-heading"><strong>Departments</strong></div>
		<div class="panel-body">
			<?php
				$stt = 1;
			?>
			<table class="table table-striped" style="width: 100%">
				<tr>
					<th>STT</th>
					<th>Name</th>
					<th>Office Phone</th>
					<th>Manager</th>
					<th>Action</th>
				</tr>
				@foreach($departments as $department)
					<tr>
						<td>{{ $stt++ }}</td>
						<td><a href="{{ url('/department/detail', $department->id) }}"> {{ $department->name }}</a></td>
						<td>{{ $department->office_phone }}</td>
						<td>
							@foreach($employees as $employee)
								@if ($employee->id == $department->manager_id)
									{{ $employee->name }}
								@endif
							@endforeach
						</td>
						<td>
							{{ Form::open(['route' => ['department.destroy', $department->id], 'method' => 'delete', 'onsubmit' => 'return ConfirmDelete()']) }}
								<a href="{{ url('/employee?department_id='.$department->id) }}" class="btn btn-warning"><i class="fa fa-users"> Employees</i></a>
								@if (Auth::user())
									<a href="{{ url('/department/edit', $department->id) }}" class="btn btn-success"><i class="glyphicon glyphicon-pencil"> Edit</i></a>
									<a href="{{ url('/department') }}" ><button type="submit" class="btn btn-info"><i class="glyphicon glyphicon-trash"> Delete</i></button></a>
								@endif
							{{ Form::close() }}
						</td>
					</tr>
				@endforeach
			</table>
		</div>
	</div>
</div>
@endsection