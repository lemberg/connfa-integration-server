@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="pull-left">
                {!! Breadcrumbs::render('breadcrumbs', ['label'=> trans('Tracks'), 'route' => 'tracks.index', 'params' => ['conference_alias' => $conference->alias]]) !!}
            </div>
            {{ Html::link(route('tracks.create', ['conference_alias' => $conference->alias]), trans('Create track'), ['class' => 'btn btn-primary pull-right']) }}
            <div class="x_panel">
                <div class="x_title">
                    <h2>{{ trans('Tracks') }}</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="table-responsive">
                        <table class="table table-striped jambo_table bulk_action">
                            <thead>
                                <tr class="headings">
                                    <th class="column-title">id</th>
                                    <th class="column-title">{{ trans('Name') }}</th>
                                    <th class="column-title no-link last"><span class="nobr">{{ trans('Action') }}</span></th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>
                                        {{ $item->name }}
                                    </td>
                                    <td class="text-right">
                                        @include('partials/actions', ['route' => 'tracks', 'id' => $item->id, 'conference_alias' => $conference->alias])
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="pull-right">
                            {!! $data->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
