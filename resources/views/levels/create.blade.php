@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Create level</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br />
                    {!! Form::open(array('url' => '/levels/', 'method' => 'post', 'class' => 'form-horizontal form-label-left')) !!}

                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            {{ Form::text('name', '', ['class' => 'form-control col-md-7 col-xs-12']) }}
                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('order') ? ' has-error' : '' }}">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Order
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            {{ Form::text('order', '', ['class' => 'form-control col-md-7 col-xs-12']) }}
                            @if ($errors->has('order'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('order') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                            {{ Form::submit('Update', ['class' => 'btn btn-success']) }}
                        </div>
                    </div>
                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
@endsection
