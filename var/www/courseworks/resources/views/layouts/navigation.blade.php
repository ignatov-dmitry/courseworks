<header id="header-container" class="fullwidth transparent">

    <!-- Header -->
    <div id="header">
        <div class="container">

            <!-- Left Side Content -->
            <div class="left-side">

                <!-- Logo -->
                <div id="logo" style="display: none">
                    <a href="/"><img src="images/logo.png" alt=""></a>
                </div>

                <!-- Main Navigation -->
                <nav id="navigation">
                    <ul id="responsive">
                        <li><a href="/">Главная</a></li>
                        <li><a href="#">Find Work</a></li>
                        <li><a href="#">For Employers</a></li>
                        <li><a href="#">Dashboard</a></li>

                    </ul>
                </nav>
                <div class="clearfix"></div>
                <!-- Main Navigation / End -->

            </div>
            <!-- Left Side Content / End -->

            <!-- Right Side Content / End -->
            <div class="right-side">

                <div class="header-widget">
                    @auth
                        <div class="header-notifications user-menu">
                            <div class="header-notifications-trigger">
                                <a href="#"><div class="user-avatar status-online"><img src="images/user-avatar-small-01.jpg" alt=""></div></a>
                            </div>

                            <!-- Dropdown -->
                            <div class="header-notifications-dropdown">

                                <!-- User Status -->
                                <div class="user-status">

                                    <!-- User Name / Avatar -->
                                    <div class="user-details">
                                        <div class="user-avatar status-online"><img src="images/user-avatar-small-01.jpg" alt=""></div>
                                        <div class="user-name">
                                            {{ Auth::user()->name }} <span>Заказчик</span>
                                        </div>
                                    </div>

                                    <!-- User Status Switcher -->
                                    <div class="status-switch" id="snackbar-user-status">
                                        <label class="user-online current-status">В сети</label>
                                        <label class="user-invisible">Невидим</label>
                                        <!-- Status Indicator -->
                                        <span class="status-indicator" aria-hidden="true"></span>
                                    </div>
                                </div>

                                <ul class="user-menu-small-nav">
                                    <li><a href="{{ route('dashboard') }}"><i class="icon-material-outline-dashboard"></i> Dashboard</a></li>
                                    <li>
                                        <x-dropdown-link :href="route('profile.edit')">
                                            <i class="icon-material-outline-settings"></i>
                                            {{ __('Настройки аккаунта') }}
                                        </x-dropdown-link>
                                    </li>
                                    <li>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <x-dropdown-link :href="route('logout')"
                                                             onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                                <i class="icon-material-outline-power-settings-new"></i>
                                                {{ __('Выйти') }}
                                            </x-dropdown-link>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="log-in-button"><i class="icon-feather-log-in"></i> <span>Войти</span></a>
                    @endauth
                </div>

                <!-- Mobile Navigation Button -->
                <span class="mmenu-trigger">
					<button class="hamburger hamburger--collapse" type="button">
						<span class="hamburger-box">
							<span class="hamburger-inner"></span>
						</span>
					</button>
				</span>
            </div>
            <!-- Right Side Content / End -->
        </div>
    </div>
    <!-- Header / End -->
</header>
