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

        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            {{ Form::email("email", old('email'), ['class' => 'form-control', 'placeholder' => 'E-Mail Address']) }}
            @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif

        </div>

        <div class="form-group">
            {{ Form::submit('Send Password Reset Link', ['class' => "btn btn-default submit"]) }}
        </div>

    {!! Form::close() !!}

@endsection





