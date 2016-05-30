@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Change Password</div>
				<div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/changepassword') }}">
                        {!! csrf_field() !!}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input type="email" class="form-control" name="email" value="{{ Auth::user()->email }}">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                                @if(Session::has('message1'))
                                    <span class="help-block">
                                        <strong>{{ Session::get('message1') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Old Password</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="password" id="password">
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                                @if(Session::has('message2'))
                                    <span class="help-block">
                                        <strong>{{ Session::get('message2') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('newpassword') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">New Password</label>
                            <div class="col-md-6">
                                <input type="password" class="form-control" name="newpassword" id="newpassword">
                                @if ($errors->has('newpassword'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('newpassword') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('newpassword_confirmation') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Confirm Password</label>
                            <div class="col-md-6">
                                <input type="password" class="form-control" name="newpassword_confirmation" id="newpassword_confirmation">

                                @if ($errors->has('newpassword_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('newpassword_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-refresh"></i>Change Password
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