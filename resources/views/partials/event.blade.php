<div class="col-md-4">
    <div class="x_panel">
        <div class="x_title">
            <h2>{{ trans($eventName) }}</h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            @foreach($events as $event)
                @include('partials/_event-article', ['eventType' => $eventType,'event' => $event])
            @endforeach
        </div>
    </div>
</div>
