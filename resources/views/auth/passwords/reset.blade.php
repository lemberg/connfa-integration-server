@extends('layouts.login')

@section('content')


    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    {!! Form::open(array('url' => '/password/email', 'method' => 'POST', 'class' => 'form-horizontal')) !!}
        {{ csrf_field() }}

        <h1>Reset Password</h1>

        {{ Form::hidden("token", $token) }}

        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            {{ Form::email("email", $email or old('email'), ['class' => 'form-control', 'placeholder' => 'E-Mail Address']) }}
            @if ($errors->has('email'))
                <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
            @endif
        </div>

        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
            {{ Form::password("password", ['class' => 'form-control', 'placeholder' => 'Password']) }}
            @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
            {{ Form::password("password_confirmation", ['class' => 'form-control', 'placeholder' => 'Confirm Password']) }}
            @if ($errors->has('password_confirmation'))
                <span class="help-block">
                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                    </span>
            @endif
        </div>

        <div class="form-group">
            {{ Form::submit('Reset Password', ['class' => "btn btn-default submit"]) }}
        </div>

    {!! Form::close() !!}

@endsection


