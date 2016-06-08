@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="pull-left">
                {!! Breadcrumbs::render(
                    'breadcrumbs',
                    [['label'=> trans('Settings'), 'route' => 'settings.index'], ['label'=> trans('Edit settings'), 'route' => 'settings.index']]
                ) !!}
            </div>
            <div class="x_panel">
                <div class="x_title">
                    <h2>{{ trans('Settings') }}</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br/>
                    {!! Form::open(['route' => ['settings.update'], 'method' => 'PUT', 'class' => 'form-horizontal form-label-left']) !!}
                    @if($data)
                        @foreach($data as $item)
                            <div class="form-group{{ $errors->has($item->key) ? ' has-error' : '' }}">
                                {{ Form::label(
                                    $item->key,
                                    trans(ucfirst(strtolower(implode(' ', preg_split('/(?=[A-Z])/', $item->key))))) .
                                        ($item->key == 'timezone' ? ' *' : '') .
                                        ($item->key == 'twitterSearchQuery' ? ' *' : ''),
                                    ['class' => "control-label col-md-3 col-sm-3 col-xs-12"]
                                ) }}
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    @if($item->key == 'timezone')
                                        @if(!empty($timezoneList))
                                            {{ Form::select(
                                                $item->key,
                                                $timezoneList,
                                                $item->value,
                                                ['class' => 'select2_single form-control col-md-7 col-xs-12']
                                            ) }}
                                        @endif
                                    @else
                                        {{ Form::text($item->key, $item->value, ['class' => 'form-control col-md-7 col-xs-12']) }}
                                    @endif
                                    @if ($errors->has($item->key))
                                        <span class="help-block">
                                            <strong>{{ $errors->first($item->key) }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    @endif
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

