
<style>
     [v-cloak] {
            display: none !important;
        }
    </style>

<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>

 {{-- @includeWhen(class_exists(\Backpack\DevTools\DevToolsServiceProvider::class), 'backpack.devtools::buttons.sidebar_item')  --}}


@if(backpack_user()->can('report.list') || backpack_user()->role('super-admin'))
    <li class="nav-item nav-dropdown">
        <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-newspaper"></i> Live Reporting</a>
        <ul class="nav-dropdown-items">
            <li class="nav-item"><a class="nav-link" href="{{ backpack_url('live') }}"><i class="nav-icon la la-exclamation"></i> Live</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ backpack_url('report') }}"><i class="nav-icon la la-list"></i> Last Reports</a></li>
        </ul>
    </li>
@endif


@if(backpack_user()->can('article.list') || backpack_user()->can('article-category.list') || backpack_user()->role('super-admin'))
    <li class="nav-item nav-dropdown">
        <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-newspaper"></i> Articles</a>
        <ul class="nav-dropdown-items">

        @if(backpack_user()->can('article.list') || backpack_user()->role('super-admin'))
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('article') }}"><i class="nav-icon la la-newspaper"></i> Manage</a></li>
        @endif


        @if(backpack_user()->can('article-category.list') || backpack_user()->role('super-admin'))
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('article-category') }}"><i class="nav-icon la la-list"></i> Categories</a></li>
        @endif

        </ul>
    </li>
@endif

<li class="nav-item nav-dropdown">
        <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-newspaper"></i> Media Reporting</a>
        <ul class="nav-dropdown-items">

        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('media-reporting') }}"><i class="nav-icon la la-list"></i> Manage</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('media-reporting-category') }}"><i class="nav-icon la la-list"></i> Categories</a></li>

        </ul>
    </li>

@if(backpack_user()->can('event.list') || backpack_user()->can('series.list') || backpack_user()->can('tour.list') || backpack_user()->role('super-admin') )
    <li class="nav-item nav-dropdown">
        <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-globe-europe"></i> Tours & Events</a>
        <ul class="nav-dropdown-items">

        @if(backpack_user()->can('event.list') || backpack_user()->role('super-admin'))
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('events') }}"><i class="nav-icon la la-calendar"></i> Events </a></li>
        @endif

        @if(backpack_user()->can('series.list') || backpack_user()->role('super-admin'))
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('series') }}"><i class="nav-icon la la-icons"></i> Series</a></li>
        @endif

        @if(backpack_user()->can('tour.list') || backpack_user()->role('super-admin'))
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('poker-tour') }}"><i class="nav-icon la la-map"></i> Tours</a></li>
        @endif

        </ul>
    </li>
@endif

@if(backpack_user()->can('player.list') || backpack_user()->role('super-admin'))
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('player') }}"><i class="nav-icon la la-user"></i> Players</a></li>
@endif


<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-newspaper"></i> CMS</a>
    <ul class="nav-dropdown-items">

    @if(backpack_user()->can('page.list') || backpack_user()->role('super-admin') )
    <li class='nav-item'><a class='nav-link' href='{{ backpack_url('page') }}'><i class='nav-icon la la-file-o'></i> <span>Pages</span></a></li>
    @endif

    @if(backpack_user()->can('menu-item.list') || backpack_user()->role('super-admin'))
    <li class='nav-item'><a class='nav-link' href='{{ backpack_url('menu-item') }}'><i class='nav-icon la la-list'></i> <span>Navigation</span></a></li>
    @endif
    <li class="nav-item"><a class="nav-link" href="{{ backpack_url('banner') }}"><i class="nav-icon la la-list"></i> Banners</a></li>

    <li class="nav-item"><a class="nav-link" href="{{ backpack_url('content') }}"><i class="nav-icon la la-list"></i> Contents</a></li>

    </ul>
</li>

@role('super-admin')
    <li class="nav-item nav-dropdown">
        <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-users"></i> Users & Roles</a>
        <ul class="nav-dropdown-items">

            @if(backpack_user()->can('author.list') || backpack_user()->role('super-admin'))
            <li class="nav-item"><a class="nav-link" href="{{ backpack_url('article-author') }}"><i class="nav-icon la la-user"></i> <span>Authors</span></a></li>
            @endif
            <li class="nav-item"><a class="nav-link" href="{{ backpack_url('user') }}"><i class="nav-icon la la-user"></i> <span>Users</span></a></li>
            <li class="nav-item"><a class="nav-link" href="{{ backpack_url('role') }}"><i class="nav-icon la la-id-badge"></i> <span>Roles</span></a></li>
            <li class="nav-item"><a class="nav-link" href="{{ backpack_url('permission') }}"><i class="nav-icon la la-key"></i> <span>Permissions</span></a></li>
        </ul>
    </li>
@endrole




<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-newspaper"></i> <span>Miscellaneous</span></a>
    <ul class="nav-dropdown-items">


    @if(backpack_user()->can('tag.list') || backpack_user()->role('super-admin'))
    <li class="nav-item"><a class="nav-link" href="{{ backpack_url('tag') }}"><i class="nav-icon la la-list"></i> <span>Tags</span></a></li>
    @endif

    @if(backpack_user()->can('image-theme.list') || backpack_user()->role('super-admin'))
    <li class="nav-item"><a class="nav-link" href="{{ backpack_url('image-theme') }}"><i class="nav-icon la la-image"></i> <span>Image themes</span></a></li>
    @endif

    <li class="nav-item"><a class="nav-link" href="{{ backpack_url('room') }}"><i class="nav-icon la la-list"></i> Rooms</a></li>
    <li class="nav-item"><a class="nav-link" href="{{ backpack_url('event-game-table') }}"><i class="nav-icon la la-list"></i>  Games </a></li>
    <li class="nav-item"><a class="nav-link" href="{{ backpack_url('glossary') }}"><i class="nav-icon la la-list"></i> Glossaries</a></li>
    <li class='nav-item'><a class='nav-link' href='{{ backpack_url('setting') }}'><i class='nav-icon la la-cog'></i> <span>Settings</span></a></li>

<!-- <li class="nav-item"><a class="nav-link" href="{{ backpack_url('currency') }}"><i class="nav-icon la la-money"></i> Currencies</a></li> -->
<!-- <li class="nav-item"><a class="nav-link" href="{{ backpack_url('live-report-player') }}"><i class="nav-icon la la-users"></i> Live report players</a></li> -->
<!-- <li class="nav-item"><a class="nav-link" href="{{ backpack_url('country') }}"><i class="nav-icon la la-flag"></i> Countries</a></li> -->

    </ul>
</li>


<!-- <li class="nav-item"><a class="nav-link" href="{{ backpack_url('event-schedule') }}"><i class="nav-icon la la-question"></i> Event schedules</a></li> -->




<style>
.imageFrame {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-repeat: no-repeat;
    background-size: contain;
    margin-left:15.4px;
}

.imageFrameCreate {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-repeat: no-repeat;
    background-size: contain;
    margin-left:15.4px;
}
.cke_reset {
    /* display:none!important; */
}

.bootstrap-datetimepicker-widget .picker-switch td span, .bootstrap-datetimepicker-widget .picker-switch td i {
color: #fff;
background-color: #f44336;
}

.bootstrap-datetimepicker-widget .picker-switch td span, .bootstrap-datetimepicker-widget .picker-switch td i:hover {
color: #fff;
background-color: #f44336;
}


.select2-container{
    width:500px!important;
}
.select2-dropdown{
    width:500px!important;
}

</style>
<!-- <li class="nav-item"><a class="nav-link" href="{{ backpack_url('day') }}"><i class="nav-icon la la-question"></i> Days</a></li> -->