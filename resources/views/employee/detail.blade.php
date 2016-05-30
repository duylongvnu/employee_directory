@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-success">
            	
                <div class="panel-heading"><strong>Employees</strong></div>
				<div class="panel-body">
					<div class="col-md-5">
						@if ($employees->photo == "")
							<img src="{{ asset('image/icon-profile.png') }}" width="250px" height="200px">
						@else
							<img src="{{ asset('image/'. $employees->photo) }}" width="250px" height="200px">
						@endif
					</div>
					<div class="col-md-7">
						<table class="table table-striped" style="width: 100%">
							<tr>
								<td><strong>Name</strong></td>
								<td>{{ $employees->name }}</td>
							</tr>
							<tr>
								<td><strong>Department</strong></td>
								<td>
									@if ($employees->department_id != "")
										{{ $department->name }}
									@endif
								</td>
							</tr>
							<tr>
								<td><strong>Job Title</strong></td>
								<td>{{ $employees->job_title }}</td>
							</tr>
							<tr>
								<td><strong>CellPhone</strong></td>
								<td>{{ $employees->cellphone }}</td>
							</tr>
							<tr>
								<td><strong>Email</strong></td>
								<td>{{ $employees->email }}</td>
							</tr>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection