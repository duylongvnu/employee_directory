@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-success">
                <div class="panel-heading">Edit Department</div>
				<div class="panel-body">
					<div class="form-horizontal">
					{{ Form::model($departments,['method' => 'PATCH', 'action' => ['department\DepartmentsController@update', $departments->id]]) }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
							<label class="col-md-4 control-label">Name</label>

							<div class="col-md-6">
                                <input type="text" class="form-control" name="name" value="{{$departments->name}}">
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                                @if(Session::has('message1'))
                                    <span class="help-block">
                                        <strong>{{ Session::get('message1') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('office_phone') ? ' has-error' : '' }}">
							<label class="col-md-4 control-label">Office Phone</label>

							<div class="col-md-6">
                                <input type="tel" class="form-control" id="office_phone" name="office_phone" value="{{$departments->office_phone}}">
                                @if ($errors->has('office_phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('office_phone') }}</strong>
                                    </span>
                                @endif
                                @if(Session::has('message2'))
                                    <span class="help-block">
                                        <strong>{{ Session::get('message2') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('manager_id') ? ' has-error' : '' }}">
							<label class="col-md-4 control-label">Manager</label>

							<div class="col-md-6">
								<select class="form-control" id="manager_id" name="manager_id">
									<option value=""></option>
									@foreach ($employees as $employee)
										@if ($departments->manager_id == $employee->id)
											<option value="{{ $employee->id }}" selected="selected">{{ $employee->name }}</option>
										@else
											<option value="{{ $employee->id }}">{{ $employee->name }}</option>
										@endif
									@endforeach
								</select>
							</div>
						</div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-pencil"></i> Edit Department
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