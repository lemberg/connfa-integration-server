@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="pull-left">
                {!! Breadcrumbs::render('breadcrumbs', [['label'=> trans('Social events'), 'route' => 'social.index'], ['label'=> trans('Social Event'), 'route' => 'social.index']]) !!}
            </div>
            {!! Form::open([route('social.destroy', ['id' => $data->id]), 'method' => 'POST', 'class' => 'pull-right']) !!}
                {{ method_field('DELETE') }}
                {{ Form::button("<i class='fa fa-trash-o'></i> Delete", ['onclick' => 'deleteItem(this)', 'class' => 'btn btn-danger']) }}
            {!! Form::close() !!}
            <a href="{{ route('social.edit', ['id' => $data->id ]) }}" class="btn btn-info pull-right"><i class="fa fa-pencil"></i> {{ trans('Edit') }}</a>
            <div class="x_panel">
                <div class="x_title">
                    <h2>{{ trans('Social event') }}</h2>
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
                        <strong>{{ trans('Level') }}:</strong>
                        @if($data->level_id)
                            {{ $data->level->name }}<br>
                        @endif
                    </p>
                    <p>
                        <strong>{{ trans('Type') }}:</strong>
                        @if($data->type_id)
                            {{ $data->type->name }}<br>
                        @endif
                    </p>
                    <p>
                        <strong>{{ trans('Track') }}:</strong>
                        @if($data->track_id)
                            {{ $data->track->name }}<br>
                        @endif
                    </p>
                    <p>
                        <strong>{{ trans('Order') }}:</strong> {{ $data->order }}<br>
                    </p>
                    <p>
                        <strong>{{ trans('Text') }}:</strong>
                        @if($data->text)
                            <pre><code>{!! $data->text !!}</code></pre>
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
