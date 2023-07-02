<header class="top-header">
    <div class="header-top-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="header-top-area-inner">
                        <a href="{{ url('/') }}" class="logo">
                            <img src="{{ asset('images/logo.png') }}" alt="">
                        </a>
                        <div class="right-area">
                            @guest
                                <div class="log-reg-area">
                                    <a href="{{ route('register') }}" class="custom-button1">Register</a>
                                    <a href="{{ route('login') }}" class="custom-button2">Sign In</a>
                                </div>
                            @endguest

                            @auth()
                                <div class="log-reg-area">
                                    <p class="text-white ml-3 font-weight-bolder">Welcome {{ Auth::user()->name }}  </p>
                                    <a href="{{ route('user.logout') }}" class="custom-button1">Logout</a>
                                </div>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="header-section">
        <div class="container">
            <div class="header-wrapper">
                <ul class="menu">
                    <li>
                        <a href="{{ route('forecasts') }}"
                            class="@if (Route::current()->getName() === 'forecasts') active @endif">Forecast</a>
                    </li>
                    <li>
                        <a href="{{ route('results') }}"
                            class="@if (Route::current()->getName() === 'results') active @endif">Results</a>
                    </li>
                    <li>
                        <a href="{{ route('timetable.home') }}"
                            class="@if (Route::current()->getName() === 'timetable.home') active @endif">Time Table</a>
                    </li>
                    <li>
                        <a href="{{ route('winning.history') }}"
                            class="@if (Route::current()->getName() === 'winning.history') active @endif">Winning History</a>
                    </li>
                </ul>
                <div class="right-tools">
                </div>
                <div class="header-bar d-lg-none">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
        </div>
    </div>
</header>
