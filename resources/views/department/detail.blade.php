@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-success">
            	
                <div class="panel-heading"><strong>Departments</strong></div>
				<div class="panel-body">
					<table class="table table-striped" style="width: 100%">
						<tr>
							<td><strong>Name</strong></td>
							<td>{{ $departments->name }}</td>
						</tr>
						<tr>
							<td><strong>Office Phone</strong></td>
							<td>{{ $departments->office_phone }}</td>
						</tr>
						<tr>
							<td><strong>Manager</strong></td>
							<td>
								@if ($departments->manager_id != "")
									{{ $employee->name }}
								@endif
							</td>
						</tr>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection