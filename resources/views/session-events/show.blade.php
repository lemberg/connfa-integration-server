@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            {!! Form::open([route('sessions.destroy', ['id' => $data->id]), 'method' => 'POST', 'class' => 'pull-right']) !!}
            {{ method_field('DELETE') }}
            {{ Form::button("<i class='fa fa-trash-o'></i> Delete", ['type' => 'submit', 'class' => 'btn btn-danger']) }}
            {!! Form::close() !!}
            <a href="{{ route('sessions.edit', ['id' => $data->id ]) }}" class="btn btn-info pull-right"><i class="fa fa-pencil"></i> {{ trans('Edit') }}</a>

            <div class="x_panel">
                <div class="x_title">
                    <h2>{{ trans('Session events') }}</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <p>
                        <strong>{{ trans('Name') }}:</strong> {{ $data->name }}<br>
                    </p>
                    <p>
                        <strong>{{ trans('Start at') }}:</strong> {{ $data->start_at }}<br>
                    </p>
                    <p>
                        <strong>{{ trans('End at') }}:</strong> {{ $data->end_at }}<br>
                    </p>
                    <p>
                        <strong>{{ count($data->speakers)>1 ? trans('Speakers') : trans('Speaker') }}:</strong>
                        {{ $data->speakers->implode('full_name', ', ') }}
                        <br>
                    </p>
                    <p>
                        <strong>{{ trans('Place') }}:</strong> {{ $data->place }}<br>
                    </p>
                    <p>
                        <strong>{{ trans('Version') }}:</strong> {{ $data->version }}<br>
                    </p>
                    <p>
                        <strong>{{ trans('Url') }}:</strong> {{ $data->url }}<br>
                    </p>
                    <p>
                        <strong>{{ trans('Event type') }}:</strong> {{ $data->event_type }}<br>
                    </p>
                    <p>
                        <strong>{{ trans('Level') }}:</strong> {{ $data->level->name }}<br>
                    </p>
                    <p>
                        <strong>{{ trans('Type') }}:</strong> {{ $data->type->name }}<br>
                    </p>
                    <p>
                        <strong>{{ trans('Track') }}:</strong> {{ $data->track->name }}<br>
                    </p>
                    <p>
                        <strong>{{ trans('Order') }}:</strong> {{ $data->order }}<br>
                    </p>
                    <p>
                        <strong>{{ trans('Text') }}:</strong>  {!! Html::decode($data->text)  !!}<br>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
