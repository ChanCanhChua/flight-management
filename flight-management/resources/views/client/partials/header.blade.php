<div class="header">
    <div class="header_banner">
        <span class="header_banner_text">
            Tham gia Hustlang Flight để có ngay cơ hội trải nghiệm cực tốt và giá ưu đãi
        </span>
        <a class="header_banner_icon">
            <i class="fa-regular fa-x"></i>
        </a>
    </div>

    <nav class="header_navbar">
        <img class="header_logo" src="img/hustlanglogo.jpg" alt="logo_web">

        @auth
        <div class="logout">
            <p class="text-account">{{ Auth::user()->name }}</p>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="logout-button" type="submit">Log out</button>
            </form>
        </div>
        @endauth

        @guest
        <div class="login">
            <a href="{{ route('login') }}">Đăng nhập</a>
        </div>
        @endguest

    </nav>
</div>
