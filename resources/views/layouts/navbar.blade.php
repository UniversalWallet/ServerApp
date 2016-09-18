<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->
            <a class="navbar-brand" href="/">
                Universal Wallet
            </a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            @unless(auth()->guest())
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    <li {{ starts_with(Route::currentRouteName(), 'dashboard.trades') ? 'class=active' : '' }}><a href="/but-ticket.html">Покупка билета</a></li>
                </ul>
            @endunless
        </div>
    </div>
</nav>
