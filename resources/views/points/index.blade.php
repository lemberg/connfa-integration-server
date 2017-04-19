@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="pull-left">
                {!! Breadcrumbs::render('breadcrumbs', ['label'=> trans('Points'), 'route' => 'points.index', 'params' => ['conference_alias' => $conference->alias]]) !!}
            </div>
            {{ Html::link(route('points.create', ['conference_alias' => $conference->alias]), trans('Create point'), ['class' => 'btn btn-primary pull-right']) }}
            <div class="x_panel">
                <div class="x_title">
                    <h2>{{ trans('Points') }}</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="table-responsive">
                        <table class="table table-striped jambo_table bulk_action">
                            <thead>
                                <tr class="headings">
                                    <th class="column-title">id</th>
                                    <th class="column-title">{{ trans('Name') }}</th>
                                    <th class="column-title">{{ trans('Details url') }}</th>
                                    <th class="column-title">{{ trans('Image') }}</th>
                                    <th class="column-title">{{ trans('Order') }}</th>
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
                                    <td>
                                        {{ $item->details_url }}
                                    </td>
                                    <td>
                                        @if(!empty($item->image))
                                            {{ Html::image($item->image, $item->name, ['class' => 'avatar img-responsive']) }}
                                        @endif
                                    </td>
                                    <td>
                                        {{ $item->order }}
                                    </td>
                                    <td class="text-right">
                                        @include('partials/actions', ['route' => 'points', 'id' => $item->id, 'conference_alias' => $conference->alias])
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
