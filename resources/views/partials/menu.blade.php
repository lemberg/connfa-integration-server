<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
        <ul class="nav side-menu">
            <li><a href="{{ route('dashboard', ['conference_alias' => $conference->alias]) }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a><i class="fa fa-puzzle-piece"></i> Events <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="{{ route('sessions.index', ['conference_alias' => $conference->alias]) }}"> Session events</a></li>
                    <li><a href="{{ route('bofs.index', ['conference_alias' => $conference->alias]) }}"> BOF events</a></li>
                    <li><a href="{{ route('social.index', ['conference_alias' => $conference->alias]) }}"> Social events</a></li>
                </ul>
            </li>
            <li><a><i class="fa fa-signal"></i> Taxonomy<span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="{{ route('levels.index', ['conference_alias' => $conference->alias]) }}"> Levels</a></li>
                    <li><a href="{{ route('tracks.index', ['conference_alias' => $conference->alias]) }}"> Tracks</a></li>
                    <li><a href="{{ route('types.index' , ['conference_alias' => $conference->alias]) }}"> Types</a></li>
                </ul>
            </li>
                <li><a href="{{ route('speakers.index', ['conference_alias' => $conference->alias]) }}"><i class="fa fa-group"></i> Speakers</a></li>
                {{--<li><a href="{{ route('points.index', ['conference_alias' => $conference->alias]) }}"><i class="fa fa-flag-checkered"></i> Points</a></li>--}}
            <li><a href="{{ route('location.index', ['conference_alias' => $conference->alias]) }}"><i class="fa fa-map-marker"></i> Location</a></li>
            <li><a href="{{ route('floors.index', ['conference_alias' => $conference->alias]) }}"><i class="fa fa-puzzle-piece"></i> Floor plans</a></li>
            <li><a href="{{ route('pages.index', ['conference_alias' => $conference->alias]) }}"><i class="fa fa-file"></i> Pages</a></li>
            @permission('edit-user')
                <li><a href="{{ route('users.index', ['conference_alias' => $conference->alias]) }}"><i class="fa fa-user"></i> Users</a></li>
            @endpermission
            <li><a href="{{ route('settings.index', ['conference_alias' => $conference->alias]) }}"><i class="fa fa-cogs"></i> Settings</a></li>
        </ul>
    </div>
</div>
