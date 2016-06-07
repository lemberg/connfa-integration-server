
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
        <h3>General</h3>
        <ul class="nav side-menu">
            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-home"></i> Dashboard</a></li>
            <li><a><i class="fa fa-puzzle-piece"></i> Events <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="{{ url('/sessions') }}"> Session events</a></li>
                    <li><a href="{{ url('/bofs') }}"> BOF events</a></li>
                    <li><a href="{{ url('/social') }}"> Social events</a></li>
                </ul>
            </li>
            <li><a><i class="fa fa-signal"></i> Event partials<span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="{{ url('/levels') }}"> Levels</a></li>
                    <li><a href="{{ url('/tracks') }}"> Tracks</a></li>
                    <li><a href="{{ url('/types') }}"> Types</a></li>
                </ul>
            </li>
            <li><a href="{{ url('/speakers') }}"><i class="fa fa-group"></i> Speakers</a></li>
            <li><a href="{{ url('/points') }}"><i class="fa fa-flag-checkered"></i> Points</a></li>
            <li><a href="{{ url('/locations') }}"><i class="fa fa-map-marker"></i> Locations</a></li>
            <li><a href="{{ url('/floors') }}"><i class="fa fa-puzzle-piece"></i> Floor plans</a></li>
            <li><a href="{{ url('/pages') }}"><i class="fa fa-file"></i> Pages</a></li>
            <li><a href="{{ url('/users') }}"><i class="fa fa-user"></i> Users</a></li>

            <li><a href="{{ url('/settings') }}"><i class="fa fa-cogs"></i> Settings</a></li>
        </ul>
    </div>
</div>

