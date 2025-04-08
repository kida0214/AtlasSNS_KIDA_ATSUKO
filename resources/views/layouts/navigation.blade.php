<header class="header">
    <div class="header-left">
        <a href="{{ route('top') }}">
            <img src="{{ asset('images/atlas.png') }}" alt="Atlas Logo" class="header-logo">
        </a>
    </div>
    <div class="header-right">
        <div class="accordion">
            <div class="accordion-item">
                <div class="accordion-title js-accordion-title">
                    {{ auth()->user()->username }} さん
                </div>
                <div class="accordion-content">
                    <ul>
                        <li><a href="{{ route('top') }}">HOME</a></li>
                        <li><a href="{{ route('profile') }}">プロフィール編集</a></li>
                        <li>
                             <form method="POST" action="{{ route('logout') }}" class="logout-form">
                               @csrf
                             <button type="submit" class="logout-button">ログアウト</button>
                             </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="header-icon">
            <img src="{{ asset(auth()->user()->icon_image ?? 'images/default-icon.png') }}" alt="icon" class="icon-img">
        </div>
    </div>
</header>
