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
            <div class="d-flex align-items-center" style="flex: 60%;">
                <img id="FcLogo" class="img-fluid" alt="logo" src="{{asset('images/FC_Fußball_gelb-01.png')}}" />
                <div>
                    <h1 class="headerlogos-first">FC-Kollbrunn-Rikon</h1>
                </div>
                <div>
                    <h1 class="headerlogos-second">Official Website</h1>
                </div>
            </div>
            <div class="d-flex align-items-center" style="flex:40%">
                <img class="img-fluid w-25" alt="adidas" src="{{asset('images/sponsors/adidas.svg')}}">

                <img class="img-fluid w-25 ml-lg-5" alt="jeep" src="{{asset('images/sponsors/jeep.svg')}}">
            </div>
        </div>

    <b-container fluid class="p-0" id="menu-container">
        <div  class="container h-100 d-flex align-items-center">
            <ul class="navbar-nav mr-auto list-unstyled d-flex align-items-center flex-row">
                <li class="nav-item {{Request::is('/') ? 'active' : ''}}">
                    <a href="{{route('home')}}" class="{{Request::is('/') ? 'active-link' : ''}}">Home</a>
                </li>
                <li class="nav-item {{Request::is('news') ? 'active' : ''}}">
                    <a href="#" class="{{Request::is('news') ? 'active-link' : ''}}">News</a>
                </li>
                <li class="nav-item {{Request::is('team') ? 'active' : ''}}">
                    <a href="{{route('team')}}" class="{{Request::is('team') ? 'active-link' : ''}}">Team</a>
                </li>
                <li class="nav-item {{Request::is('agenda') ? 'active' : ''}}">
                    <a href="#" class="{{Request::is('agenda') ? 'active-link' : ''}}">Agenda</a>
                </li>
                <li class="nav-item {{Request::is('events') ? 'active' : ''}}">
                    <a href="#" class="{{Request::is('events') ? 'active-link' : ''}}">Events</a>
                </li>
                <li class="nav-item {{Request::is('live_ticker') ? 'active' : ''}}">
                    <a href="#" class="{{Request::is('live_ticker') ? 'active-link' : ''}}">Live Ticker</a>
                </li>
                <li class="nav-item {{Request::is('scoreboard') ? 'active' : ''}}">
                    <a href="#" class="{{Request::is('scoreboard') ? 'active-link' : ''}}">Scoreboard</a>
                </li>
                <li class="nav-item {{Request::is('contact_us') ? 'active' : ''}}">
                    <a href="#" class="{{Request::is('contact_us') ? 'active-link' : ''}}">Contact Us / Become a member</a>
                </li>
            </ul>
        </div>
    </b-container>
</div>