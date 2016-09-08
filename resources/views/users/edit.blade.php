@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="pull-left">
                {!! Breadcrumbs::render('breadcrumbs', [['label'=> trans('Users'), 'route' => 'users.index'], ['label'=> trans('Edit user'), 'route' => 'users.index']]) !!}
            </div>
            <div class="x_panel">
                <div class="x_title">
                    <h2>{{ trans('Edit user') }}</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br/>
                    {!! Form::open(['route' => ['users.update', 'id' => $data->id], 'method' => 'PUT', 'class' => 'form-horizontal form-label-left']) !!}
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            {{ Form::label('name', trans('Name')." *", ['class' => "control-label col-md-3 col-sm-3 col-xs-12"]) }}
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                {{ Form::text('name', $data->name, ['class' => 'form-control col-md-7 col-xs-12']) }}
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            {{ Form::label('email', trans('Email')." *", ['class' => "control-label col-md-3 col-sm-3 col-xs-12"]) }}
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                {{ Form::email('email', $data->email, ['class' => 'form-control col-md-7 col-xs-12']) }}
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('change_password') ? ' has-error' : '' }}">
                            {{ Form::label('change_password', trans('Change password'), ['class' => "control-label col-md-3 col-sm-3 col-xs-12"]) }}
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                {{ Form::checkbox('change_password', 'true', false, ['class' => 'form-control col-md-7 col-xs-12 flat']) }}
                                @if ($errors->has('change_password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('change_password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                       <div class="change-password" style="{{ empty(old('change_password'))? 'display:none;' : 'display:block;' }}">
                           <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                               {{ Form::label('password', trans('New password')." *", ['class' => "control-label col-md-3 col-sm-3 col-xs-12"]) }}
                               <div class="col-md-6 col-sm-6 col-xs-12">
                                   {{ Form::password('password', ['class' => 'form-control col-md-7 col-xs-12']) }}
                                   @if ($errors->has('password'))
                                       <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                   @endif
                               </div>
                           </div>
                           <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                               {{ Form::label('password_confirmation', trans('New password confirmation')." *", ['class' => "control-label col-md-3 col-sm-3 col-xs-12"]) }}
                               <div class="col-md-6 col-sm-6 col-xs-12">
                                   {{ Form::password('password_confirmation', ['class' => 'form-control col-md-7 col-xs-12']) }}
                                   @if ($errors->has('password_confirmation'))
                                       <span class="help-block">
                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                        </span>
                                   @endif
                               </div>
                           </div>
                       </div>
                        <div class="form-group{{ $errors->has('roles') ? ' has-error' : '' }}">
                            {{ Form::label('roles', trans('Roles'), ['class' => "control-label col-md-3 col-sm-3 col-xs-12"]) }}
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                {{ Form::select('roles', $roles, $data->roles->pluck('id')->toArray(), ['class' => 'form-control col-md-7 col-xs-12 select2_multiple', 'multiple' => 'multiple', 'name' => 'roles[]']) }}
                                @if ($errors->has('roles'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('roles') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                {{ Form::submit(trans('Update'), ['class' => 'btn btn-success']) }}
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection

