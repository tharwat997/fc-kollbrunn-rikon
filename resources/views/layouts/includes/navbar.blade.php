<div id="navigation">
    <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
        <div class="container">

            <div id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto list-unstyled m-0 d-flex flex-row align-items-center">
                    <li class="nav-item">
                        <a href="https://clubcorner.ch" class="pl-0">clubcorner.ch</a>
                    </li>
                    <li class="nav-item">
                        <a href="https://www.fvrz.ch">fvrz.ch</a>
                    </li>
                </ul>

            </div>
        </div>
    </nav>

    <div id="headerLogos-container" class="d-flex align-items-center container">

        <div class="row w-100">
                <div class="col-sm-12 d-flex align-items-center p-0">
                    <div class="d-flex align-items-center">
                        <img id="FcLogo" class="img-fluid" alt="logo" src="{{asset('images/FC_Fußball_gelb-01.png')}}" />
                        <div>
                            <h1 class="headerlogos-first">FC-Kollbrunn-Rikon</h1>
                        </div>
                        <div>
                            <h1 class="headerlogos-second">Official Website</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <b-container fluid class="p-0" id="menu-container">
        <b-navbar toggleable="md" type="dark">

            <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>

            <b-collapse id="nav-collapse" is-nav>
                <b-navbar-nav class="ml-auto mr-auto">
                    <b-nav-item  href="{{route('home')}}" class="{{Request::is('/') ? 'active-link' : ''}}">Home</b-nav-item>

                    <b-nav-item-dropdown text="Team" left>
                        <div class="d-flex">
                            <div id="teamDropdownFirst" class="pr-4 pl-4" style="border-right: 1px solid lightgray">
                                <b-dropdown-item href="{{url('/team/first-team')}}">First Team</b-dropdown-item>
                                <b-dropdown-item href="{{url('/team/junior-c')}}">Junior C</b-dropdown-item>
                                <b-dropdown-item href="{{url('/team/junior-d')}}">Junior D</b-dropdown-item>
                                <b-dropdown-item href="{{url('/team/junior-e')}}">Junior E</b-dropdown-item>
                                <b-dropdown-item href="{{url('/team/junior-f')}}">Junior F</b-dropdown-item>
                            </div>

                            <div id="teamDropDownSecond" class="ml-4 mr-4">
                                <b-dropdown-item href="{{url('/team/board-of-directors')}}">Board of directors</b-dropdown-item>
                            </div>
                        </div>
                    </b-nav-item-dropdown>

                    <b-nav-item  href="{{route('live_ticker')}}" class="{{Request::is('live_ticker') ? 'active-link' : ''}}">Live Ticker</b-nav-item>
                    <b-nav-item  href="{{route('agenda')}}" class="{{Request::is('agenda') ? 'active-link' : ''}}">Agenda</b-nav-item>
                    <b-nav-item  href="{{route('news')}}" class="{{Request::is('news') ? 'active-link' : ''}}">News</b-nav-item>
                    <b-nav-item  href="{{route('events')}}" class="{{Request::is('events') ? 'active-link' : ''}}">Events</b-nav-item>

                    <b-nav-item-dropdown text="Scoreboard" left>
                        <div id="teamDropdownFirst" class="pr-4 pl-4" style="border-right: 1px solid lightgray">
                            <b-dropdown-item href="">First Team Scoreboard</b-dropdown-item>
                            <b-dropdown-item href="">Junior C Scoreboard</b-dropdown-item>
                            <b-dropdown-item href="">Junior D Scoreboard</b-dropdown-item>
                            <b-dropdown-item href="">Junior E Scoreboard</b-dropdown-item>
                            <b-dropdown-item href="">Junior F Scoreboard</b-dropdown-item>
                        </div>
                    </b-nav-item-dropdown>
                    <b-nav-item  href="{{route('contact_us')}}" class="{{Request::is('contact_us') ? 'active-link' : ''}}">Contact</b-nav-item>

                </b-navbar-nav>
            </b-collapse>

        </b-navbar>
    </b-container>
</div>