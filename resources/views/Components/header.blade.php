<header>
        <h1>Chrysalis Airlines</h1>
        <div class="nav-links">
            <nav>
                <ul>
                    <li><a href="#home">Home</a></li>
                    <li><a href="#destinations">Destinations</a></li>
                    <li><a href="#book">Book a Flight</a></li>
                    <li><a href="#contact">Contact</a></li>
                </ul>
            </nav>
            <div class="auth-buttons">
                    @guest
                        @if (Route::has('login'))
                            <button><a href="{{ route('login') }}">{{ __('Login') }}</a></button>
                        @endif

                        @if (Route::has('register'))
                            <button><a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a></button>
                        @endif
            </div>
        </div>
</header>
