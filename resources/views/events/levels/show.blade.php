@extends('layouts.app')

@section('content')
    <div class="col-md-12 col-sm-12 col-xs-12">
        {!! Form::open([route('levels.destroy', ['id' => $data->id]), 'method' => 'POST', 'class' => 'pull-right']) !!}
            {{ method_field('DELETE') }}
            {{ Form::button("<i class='fa fa-trash-o'></i> Delete", ['type' => 'submit', 'class' => 'btn btn-danger']) }}
        {!! Form::close() !!}
        <a href="{{ route('levels.edit', ['id' => $data->id ]) }}" class="btn btn-info pull-right"><i class="fa fa-pencil"></i> {{ trans('Edit') }}</a>

        <div class="x_panel">
            <div class="x_title">
                <h2>{{ trans('Level') }}</h2>
                <div class="clearfix"></div>
            </div>

            <div class="x_content">
                <p>
                    <strong>{{ trans('Name') }}:</strong> {{ $data->name }}<br>
                </p>
                <p>
                    <strong>{{ trans('Order') }}:</strong> {{ $data->order }}<br>
                </p>
            </div>
        </div>
    </div>
@endsection
