@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            {!! Breadcrumbs::render('breadcrumbs', false) !!}
            @include('partials/event',['eventName' => trans('Last updated sessions'), 'eventType' => 'sessions', 'events' => $sessions])
            @include('partials/event',['eventName' => trans('Last updated BOFs'), 'eventType' => 'bofs', 'events' => $bofs])
            @include('partials/event',['eventName' => trans('Last updated social'), 'eventType' => 'social', 'events' => $social])
            <div class="clearfix"></div>
            @if($speakers)
                <div class="page-title">
                    <div class="title_left">
                        <h3>{{ trans('Last updated speakers') }}</h3>
                    </div>
                </div>
                @foreach($speakers as $speaker)
                    @include('partials/speaker', ['speaker' => $speaker])
                @endforeach
            @endif
        </div>
    </div>
@endsection
