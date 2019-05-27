<!-- Main Sidebar -->
<aside class="main-sidebar col-12 col-md-3 col-lg-2 px-0">
    <div class="main-navbar">
        <nav class="navbar align-items-stretch navbar-light bg-white flex-md-nowrap border-bottom p-0">
            <a class="navbar-brand w-100 mr-0" href="{{route('dashboard')}}" style="line-height: 25px;">
                <div class="d-table m-auto">
                    <img id="main-logo" class="d-inline-block align-top mr-1" style="max-width: 25px;" src="{{asset('images/FC_Fußball-01.png')}}" alt="Fc-Kollbrunn-Rikon">
                    <span class="d-none d-md-inline ml-1">Fc-Kollbrunn-Rikon</span>
                </div>
            </a>
            <a class="toggle-sidebar d-sm-inline d-md-none d-lg-none">
                <i class="material-icons">&#xE5C4;</i>
            </a>
        </nav>
    </div>
    <form action="#" class="main-sidebar__search w-100 border-right d-sm-flex d-md-none d-lg-none">
        <div class="input-group input-group-seamless ml-3">
            <div class="input-group-prepend">
                <div class="input-group-text">
                    <i class="fas fa-search"></i>
                </div>
            </div>
            <input class="navbar-search form-control" type="text" placeholder="Search for something..." aria-label="Search"> </div>
    </form>
    <div class="nav-wrapper">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{request()->is('/dashboard') ? 'active' : ''}}" href="{{route('dashboard')}}">
                    <i class="material-icons">dashboard</i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-nowrap px-3 {{request()->is('post*') ? 'active' : ''}}" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="true">
                    <i class="material-icons">vertical_split</i>
                    <span class="d-none d-md-inline-block">News</span>
                </a>
                <div class="dropdown-menu dropdown-menu-small">
                    <a class="dropdown-item {{request()->is('post/add') ? 'active' : ''}}" href="{{route('post_create')}}">
                        <i class="material-icons">add_circle</i>
                        Add post
                    </a>
                    <a class="dropdown-item {{request()->is('posts/manage') ? 'active' : ''}}" href="{{route('posts_manage')}}">
                        <i class="material-icons">control_camera</i>
                        Manage posts
                    </a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-nowrap px-3 {{request()->is('match*') ? 'active' : ''}}" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="true">
                    <i class="material-icons">live_tv</i>
                    <span class="d-none d-md-inline-block">Live Ticker</span>
                </a>
                <div class="dropdown-menu dropdown-menu-small">
                    <a class="dropdown-item {{request()->is('match/add') ? 'active' : ''}}" href="{{route('match_create')}}">
                        <i class="material-icons">add_circle</i>
                        Add match
                    </a>
                    <a class="dropdown-item {{request()->is('match/manage') ? 'active' : ''}}" href="{{route('matches_manage')}}">
                        <i class="material-icons">control_camera</i>
                        Manage matches
                    </a>
                    <a class="dropdown-item {{request()->is('matches*') ? 'active' : ''}}" href="{{route('matches')}}">
                        <i class="material-icons">event</i>
                        Match events
                    </a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-nowrap px-3 {{request()->is('agenda*') ? 'active' : ''}}" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="true">
                    <i class="material-icons">date_range</i>
                    <span class="d-none d-md-inline-block">Agenda</span>
                </a>
                <div class="dropdown-menu dropdown-menu-small">
                    <a class="dropdown-item {{request()->is('agenda/add') ? 'active' : ''}}" href="{{route('agenda_events_create')}}">
                        <i class="material-icons">add_circle</i>
                        Add event
                    </a>
                    <a class="dropdown-item {{request()->is('agenda/manage') ? 'active' : ''}}" href="{{route('agenda_events_manage')}}">
                        <i class="material-icons">control_camera</i>
                        Manage events
                    </a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-nowrap px-3 {{request()->is('events*') ? 'active' : ''}}" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="true">
                    <i class="material-icons">event</i>
                    <span class="d-none d-md-inline-block">Events</span>
                </a>
                <div class="dropdown-menu dropdown-menu-small">
                    <a class="dropdown-item {{request()->is('events/add') ? 'active' : ''}}" href="{{route('events_create')}}">
                        <i class="material-icons">add_circle</i>
                        Add event
                    </a>
                    <a class="dropdown-item {{request()->is('events/manage') ? 'active' : ''}}" href="{{route('events_manage')}}">
                        <i class="material-icons">control_camera</i>
                        Manage events
                    </a>
                </div>
            </li>
            @if(\Illuminate\Support\Facades\Auth::user()->hasRole('admin'))
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-nowrap px-3 {{request()->is('manage*') ? 'active' : ''}}" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="true">
                        <i class="material-icons">people</i>
                        <span class="d-none d-md-inline-block">Teams</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-small">
                        <a class="dropdown-item {{request()->is('teams/add') ? 'active' : ''}}" href="{{route('teams_create')}}">
                            <i class="material-icons">add_circle</i>
                            Add team
                        </a>
                        <a class="dropdown-item {{request()->is('teams/manage') ? 'active' : ''}}" href="{{route('teams_manage')}}">
                            <i class="material-icons">control_camera</i>
                            Manage teams
                        </a>
                    </div>
                </li>
            @endif
            @if(\Illuminate\Support\Facades\Auth::user()->hasRole('admin'))
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-nowrap px-3 {{request()->is('players*') ? 'active' : ''}}" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="true">
                        <i class="material-icons">person</i>
                        <span class="d-none d-md-inline-block">Players</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-small">
                        <a class="dropdown-item {{request()->is('players/add') ? 'active' : ''}}" href="{{route('players_create')}}">
                            <i class="material-icons">add_circle</i>
                            Add player
                        </a>
                        <a class="dropdown-item {{request()->is('players/manage') ? 'active' : ''}}" href="{{route('players_manage')}}">
                            <i class="material-icons">control_camera</i>
                            Manage players
                        </a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-nowrap px-3 {{request()->is('board*') ? 'active' : ''}}" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="true">
                        <i class="material-icons">people</i>
                        <span class="d-none d-md-inline-block">Board members</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-small">
                        <a class="dropdown-item {{request()->is('board/add') ? 'active' : ''}}" href="{{route('board_create')}}">
                            <i class="material-icons">add_circle</i>
                            Add board member
                        </a>
                        <a class="dropdown-item {{request()->is('board/manage') ? 'active' : ''}}" href="{{route('board_manage')}}">
                            <i class="material-icons">control_camera</i>
                            Manage board members
                        </a>
                    </div>
                </li>
            @endif
            <li class="nav-item">
                <a class="nav-link {{request()->is('message*') ? 'active' : ''}}" href="{{route('messages')}}" style="padding:15px 16px;">
                    <i class="material-icons">message</i>
                    <span>Messages</span>
                </a>
            </li>

            @if(\Illuminate\Support\Facades\Auth::user()->hasRole('admin'))
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-nowrap px-3 {{request()->is('user*') ? 'active' : ''}}" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="true">
                        <i class="material-icons">person</i>
                        <span class="d-none d-md-inline-block">Users</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-small">
                        <a class="dropdown-item {{request()->is('user/add') ? 'active' : ''}}" href="{{route('user_create')}}">
                            <i class="material-icons">add_circle</i>
                            Add user
                        </a>
                        <a class="dropdown-item {{request()->is('user/manage') ? 'active' : ''}}" href="{{route('user_manage')}}">
                            <i class="material-icons">control_camera</i>
                            Manage users
                        </a>
                    </div>
                </li>
            @endif
            @if(\Illuminate\Support\Facades\Auth::user()->hasRole('reporter'))
                <li class="nav-item">
                    <a class="nav-link {{request()->is('/user/manage') ? 'active' : ''}}" href="{{route('user_manage')}}">
                        <i class="material-icons">person</i>
                        <span>Profile</span>
                    </a>
                </li>
            @endif
        </ul>
    </div>
</aside>
<!-- End Main Sidebar -->