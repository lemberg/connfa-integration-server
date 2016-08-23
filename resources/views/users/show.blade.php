@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="pull-left">
                {!! Breadcrumbs::render('breadcrumbs', [['label'=> trans('Users'), 'route' => 'users.index'], ['label'=> trans('User'), 'route' => 'users.index']]) !!}
            </div>
            {!! Form::open([route('users.destroy', ['id' => $data->id]), 'method' => 'POST', 'class' => 'pull-right']) !!}
                {{ method_field('DELETE') }}
                {{ Form::button("<i class='fa fa-trash-o'></i> Delete", ['onclick' => 'deleteItem(this)', 'class' => 'btn btn-danger']) }}
            {!! Form::close() !!}
            <a href="{{ route('users.edit', ['id' => $data->id ]) }}" class="btn btn-info pull-right"><i class="fa fa-pencil"></i> {{ trans('Edit') }}</a>
            <div class="x_panel">
                <div class="x_title">
                    <h2>{{ trans('User') }}</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <p>
                        <strong>{{ trans('Name') }}:</strong> {{ $data->name }}<br>
                    </p>
                    <p>
                        <strong>{{ trans('Email') }}:</strong> {{ $data->email }}<br>
                    </p>
                    @if($data->roles)
                        <p>
                            <strong>{{ count($data->roles)>1 ? trans('Roles') : trans('Role') }}:</strong>
                            {{ $data->roles->implode('display_name', ', ') }}
                            <br>
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
