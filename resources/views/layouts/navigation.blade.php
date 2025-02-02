<header>
  <div class="header-logo-container">
    <a href="{{ route('top') }}">
      <img src="images/atlas.png" alt="Atlas Logo" class="header-logo">
    </a>
  </div>
  </header>

  <div class="accordion">
    <div class="accordion-item">
      <div class="accordion-title js-accordion-title">{{ auth()->user()->username }} さん</div>

      <div class="accordion-content">
        <li><a href="{{ route('top') }}">HOME</a></li>
        <li><a href="{{ route('profile') }}">プロフィール編集</a></li>
        <form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit">ログアウト</button>
</form>
      </div>
    </div>
  </div>

  <div class="header-icon">
    <a href="#">
      <img src="images/icon1.png" alt="icon" class="header-icon">
    </a>
  </div>
