{{-- This file is used to store sidebar items, inside the Backpack admin panel --}}
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>

@includeWhen(class_exists(\Backpack\DevTools\DevToolsServiceProvider::class), 'backpack.devtools::buttons.sidebar_item')

@role('super-admin')
<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-users"></i> Authentication</a>
    <ul class="nav-dropdown-items">
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('user') }}"><i class="nav-icon la la-user"></i> <span>Users</span></a></li>
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('role') }}"><i class="nav-icon la la-id-badge"></i> <span>Roles</span></a></li>
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('permission') }}"><i class="nav-icon la la-key"></i> <span>Permissions</span></a></li>
    </ul>
</li>
@endrole

<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-heart"></i> Poker</a>
    <ul class="nav-dropdown-items">

<li class="nav-item"><a class="nav-link" href="{{ backpack_url('event-schedule') }}"><i class="nav-icon la la-calendar"></i> Event schedules</a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('live-report') }}"><i class="nav-icon la la-table"></i> Live reports</a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('poker-tour') }}"><i class="nav-icon la la-plane"></i> Poker tours</a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('poker-tournament') }}"><i class="nav-icon la la-heart"></i> Poker tournaments</a></li>

    </ul>
</li>




<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-newspaper"></i> Articles</a>
    <ul class="nav-dropdown-items">

<li class="nav-item"><a class="nav-link" href="{{ backpack_url('article') }}"><i class="nav-icon la la-newspaper"></i> Manage</a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('article-category') }}"><i class="nav-icon la la-list"></i> Categories</a></li>

    </ul>
</li>



<li class='nav-item'><a class='nav-link' href='{{ backpack_url('page') }}'><i class='nav-icon la la-file-o'></i> <span>Pages</span></a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('elfinder') }}"><i class="nav-icon la la-files-o"></i> <span>{{ trans('backpack::crud.file_manager') }}</span></a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('setting') }}'><i class='nav-icon la la-cog'></i> <span>Settings</span></a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('live-report-player') }}"><i class="nav-icon la la-users"></i> Live report players</a></li>