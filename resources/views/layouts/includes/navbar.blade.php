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

                    <b-nav-item-dropdown text="Teams" left>
                        <div class="d-flex">
                            <div id="teamDropdownFirst" class="pr-4 pl-4" style="border-right: 1px solid lightgray">
                                <b-dropdown-item href="{{url('/team/first-team')}}">Aktive</b-dropdown-item>
                                <b-dropdown-item href="{{url('/team/junior-c')}}">C Junioren</b-dropdown-item>
                                <b-dropdown-item href="{{url('/team/junior-d')}}">D Junioren</b-dropdown-item>
                                <b-dropdown-item href="{{url('/team/junior-e')}}">E Junioren</b-dropdown-item>
                                <b-dropdown-item href="{{url('/team/junior-f')}}">F+G Junioren</b-dropdown-item>
                            </div>

                            <div id="teamDropDownSecond" class="ml-4 mr-4">
                                <b-dropdown-item href="{{url('/team/board-of-directors')}}">Vorstand</b-dropdown-item>
                            </div>
                        </div>
                    </b-nav-item-dropdown>

                    <b-nav-item  href="{{route('live_ticker')}}" class="{{Request::is('live_ticker') ? 'active-link' : ''}}">Live Ticker</b-nav-item>
                    <b-nav-item  href="{{route('agenda')}}" class="{{Request::is('agenda') ? 'active-link' : ''}}">Agenda</b-nav-item>
                    <b-nav-item  href="{{route('news')}}" class="{{Request::is('news') ? 'active-link' : ''}}">News</b-nav-item>
                    <b-nav-item  href="{{route('events')}}" class="{{Request::is('events') ? 'active-link' : ''}}">Veranstaltungen</b-nav-item>

                    <b-nav-item-dropdown text="Tabelle" left>
                        <div id="teamDropdownFirst" class="pr-4 pl-4" style="border-right: 1px solid lightgray">
                            <b-dropdown-item href="https://www.fvrz.ch/Fussballverband-Region-Zuerich/Vereine-FVRZ/Verein-FVRZ.aspx/v-1488/t-37912/ls-18110/sg-52960/a-trr/">FC Kollbrunn-Rikon 1</b-dropdown-item>
                            <b-dropdown-item href="https://www.fvrz.ch/Fussballverband-Region-Zuerich/Vereine-FVRZ/Verein-FVRZ.aspx/v-1488/t-49364/ls-18253/sg-53273/a-trr/">C Junioren</b-dropdown-item>
                            <b-dropdown-item href="https://www.fvrz.ch/Fussballverband-Region-Zuerich/Vereine-FVRZ/Verein-FVRZ.aspx/v-1488/t-56096/ls-18387/sg-53641/a-trr/">D Junioren</b-dropdown-item>
                            <b-dropdown-item href="https://www.fvrz.ch/Fussballverband-Region-Zuerich/Vereine-FVRZ/Verein-FVRZ.aspx/v-1488/t-37924/ls-18418/sg-53751/a-trr/">E Junioren</b-dropdown-item>
                            <b-dropdown-item href="https://www.fvrz.ch/Fussballverband-Region-Zuerich/Vereine-FVRZ/Verein-FVRZ.aspx/v-1488/t-37925/ls-0/sg-0/a-trr/">F Junioren</b-dropdown-item>
                        </div>
                    </b-nav-item-dropdown>
                    <b-nav-item  href="{{route('contact_us')}}" class="{{Request::is('contact_us') ? 'active-link' : ''}}">Kontakt</b-nav-item>

                </b-navbar-nav>
            </b-collapse>

        </b-navbar>
    </b-container>
</div>
