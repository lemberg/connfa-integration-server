@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="pull-left">
                {!! Breadcrumbs::render('breadcrumbs', [['label'=> trans('Speakers'), 'route' => 'speakers.index'], ['label'=> trans('Speaker'), 'route' => 'speakers.index']]) !!}
            </div>
            <div class="x_panel">
                <div class="x_title">
                    <h2>{{ trans('Speaker') }}</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
                        @if($data->avatar)
                            <div class="profile_img">
                                <div id="crop-avatar">
                                    <img class="img-responsive avatar-view" src="{{ $data->avatar }}" alt="{{ $data->first_name }} {{ $data->last_name }}" title="{{ $data->first_name }} {{ $data->last_name }}">
                                </div>
                            </div>
                        @endif
                        <h3>{{ $data->first_name }} {{ $data->last_name }}</h3>
                        <ul class="list-unstyled user_data">
                            <li>
                                <i class="fa fa-briefcase user-profile-icon" title="{{ trans('Job') }}"></i> {{ $data->job }}
                            </li>
                            <li>
                                <i class="fa fa-institution user-profile-icon" title="{{ trans('Organization') }}"></i> {{ $data->organization }}
                            </li>
                            <li>
                                <i class="fa fa-envelope user-profile-icon" title="{{ trans('Email') }}"></i> {{ Html::email($data->email) }}
                            </li>
                            <li>
                                <i class="fa fa-external-link user-profile-icon" title="{{ trans('Website') }}"></i> {{ Html::link($data->website, 'website') }}
                            </li>
                            <li class="m-top-xs">
                                <i class="fa fa-twitter user-profile-icon" title="{{ trans('Twitter') }}"></i>
                                <a href="https://twitter.com/{{ $data->twitter_name }}" target="_blank">{{ $data->twitter_name }}</a>
                            </li>
                            <li>
                                <i class="fa fa-sort-amount-asc user-profile-icon" title="{{ trans('Order') }}"></i> {{ $data->order }}
                            </li>
                        </ul>
                        <a href="{{ route('speakers.edit', ['id' => $data->id ]) }}" class="btn btn-success"><i class="fa fa-edit m-right-xs"></i> {{ trans('Edit') }}</a>
                        {!! Form::open([route('speakers.destroy', ['id' => $data->id]), 'method' => 'POST', 'class' => '', 'style' => 'display:inline-block;vertical-align: middle;
']) !!}
                            {{ method_field('DELETE') }}
                            {{ Form::button("<i class='fa fa-trash-o'></i> Delete", ['onclick' => 'deleteItem(this)', 'class' => 'btn btn-danger']) }}
                        {!! Form::close() !!}
                        <br />
                    </div>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                        <div class="profile_title">
                            <div class="col-md-6">
                                <h2>{{ trans('Characteristic') }}</h2>
                            </div>
                        </div>
                        <br>
                        @if($data->characteristic)
                            <pre><code>{!! $data->characteristic !!}</code></pre>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
