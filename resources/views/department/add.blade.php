@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-success">
                <div class="panel-heading">Add Department</div>
				<div class="panel-body">
					<form class="form-horizontal" role="form" method="POST" action="{{ url('/department') }}">
                        {!! csrf_field() !!}
						<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
							<label class="col-md-4 control-label">Name</label>

							<div class="col-md-6">
                                <input type="text" class="form-control" name="name">
                            </div>
                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('office_phone') ? ' has-error' : '' }}">
							<label class="col-md-4 control-label">Office Phone</label>

							<div class="col-md-6">
                                <input type="tel" class="form-control" id="office_phone" name="office_phone">
                            </div>
                            @if ($errors->has('office_phone'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('office_phone') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('manager_id') ? ' has-error' : '' }}">
							<label class="col-md-4 control-label">Manager</label>

							<div class="col-md-6">
								<select class="form-control" id="manager_id" name="manager_id">
									<option value=""></option>
                                    @foreach ($employees as $employee)
                                        <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                                    @endforeach
								</select>
							</div>
						</div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">Add Department
                                </button>
                            </div>
                        </div>
					</form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection