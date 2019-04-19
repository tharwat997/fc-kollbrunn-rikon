<div id="navigation">
    <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
        <div class="container">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto list-unstyled m-0">
                    <li class="nav-item">
                        <a href="#" class="pl-0">clubcorner.ch</a>
                    </li>
                    <li class="nav-item">
                        <a href="#">fvrz.ch</a>
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
                    <div class="d-flex ml-auto align-items-center">
                        <div id="adidas-image-container">
                            <img class="img-fluid" alt="adidas" src="{{asset('images/sponsors/adidas.svg')}}" />
                        </div>
                        <div id="jeep-image-container">
                            <img class="img-fluid ml-5" alt="jeep" src="{{asset('images/sponsors/jeep.svg')}}" />
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <b-container fluid class="p-0" id="menu-container">
        <div  class="container h-100 d-flex align-items-center">
            <ul class="navbar-nav mr-auto list-unstyled d-flex align-items-center flex-row">
                <li class="nav-item {{Request::is('/') ? 'active' : ''}}">
                    <a href="{{route('home')}}" class="{{Request::is('/') ? 'active-link' : ''}}">Home</a>
                </li>
                <li class="nav-item {{Request::is('team') ? 'active' : ''}}">

                    <b-dropdown variant="link" size="lg">
                        <template slot="button-content">
                            <a href="#" class="{{Request::is('team') ? 'active-link' : ''}}">Team</a>
                        </template>
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
                    </b-dropdown>

                </li>
                <li class="nav-item {{Request::is('live_ticker') ? 'active' : ''}}">
                    <a href="{{route('live_ticker')}}" class="{{Request::is('live_ticker') ? 'active-link' : ''}}">Live Ticker</a>
                </li>
                <li class="nav-item {{Request::is('agenda') ? 'active' : ''}}">
                    <a href="{{route('agenda')}}" class="{{Request::is('agenda') ? 'active-link' : ''}}">Agenda</a>
                </li>
                <li class="nav-item {{Request::is('news') ? 'active' : ''}}">
                    <a href="{{route('news')}}" class="{{Request::is('news') ? 'active-link' : ''}}">News</a>
                </li>

                <li class="nav-item {{Request::is('events') ? 'active' : ''}}">
                    <a href="{{route('events')}}" class="{{Request::is('events') ? 'active-link' : ''}}">Events</a>
                </li>

                <li class="nav-item {{Request::is('scoreboard') ? 'active' : ''}}">

                    <b-dropdown variant="link" size="lg">
                        <template slot="button-content">
                            <a href="#" class="{{Request::is('team') ? 'active-link' : ''}}">Scoreboard</a>
                        </template>
                        <div class="d-flex">
                            <div id="teamDropdownFirst">
                                <b-dropdown-item href="">First Team Scoreboard</b-dropdown-item>
                                <b-dropdown-item href="">Junior C Scoreboard</b-dropdown-item>
                                <b-dropdown-item href="">Junior D Scoreboard</b-dropdown-item>
                                <b-dropdown-item href="">Junior E Scoreboard</b-dropdown-item>
                                <b-dropdown-item href="">Junior F Scoreboard</b-dropdown-item>
                            </div>

                        </div>
                    </b-dropdown>

                </li>
                <li class="nav-item {{Request::is('contact_us') ? 'active' : ''}}">
                    <a href="{{route('contact_us')}}" class="{{Request::is('contact_us') ? 'active-link' : ''}}">Contact Us / Become a member</a>
                </li>
            </ul>
        </div>
    </b-container>
</div>