<article class="media event">
    <a class="pull-left date">
        <p class="month">{{ $event->start_at->format("M") }}</p>
        <p class="day">{{ $event->start_at->format("d") }}</p>
    </a>
    <div class="media-body">
        <a class="title" href="{{ route($eventType.'.show', ['id' => $event->id, 'conference_alias' => $conference->alias]) }}">{{ $event->name }}</a>
        <p>{{ str_limit(strip_tags($event->text), 250) }}</p>
    </div>
</article>