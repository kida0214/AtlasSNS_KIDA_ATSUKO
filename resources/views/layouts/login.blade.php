<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <!-- IEブラウザ対策 -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="description" content="ページの内容を表す文章" />
  <title></title>

  <!-- CSSファイル -->
  <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">

  <!-- スマホ・タブレット対応 -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- サイトのアイコン指定 -->
  <link rel="icon" href="画像URL" sizes="16x16" type="image/png">
  <link rel="icon" href="画像URL" sizes="32x32" type="image/png">
  <link rel="icon" href="画像URL" sizes="48x48" type="image/png">
  <link rel="icon" href="画像URL" sizes="62x62" type="image/png">

  <!-- iPhoneのアプリアイコン指定 -->
  <link rel="apple-touch-icon-precomposed" href="画像のURL">
</head>

<body>
  <header>
    @include('layouts.navigation')
  </header>

  <!-- メインコンテンツ -->
  <div id="row">
    <div id="container">
      {{ $slot }}
    </div> <!-- container 終了 -->

    <!-- サイドバー -->
    <div id="side-bar">
      <div class="follow-info">
        {{ auth()->user()->username }} さんの
      </div>

      <div class="follow-info">
        フォロー数 {{ Auth::user()->followingCount() }}人
      </div>

      <!-- フォローリスト -->
      <div class="list-header">
        <nav>
          <ul>
            <li><a href="{{ route('follow.list') }}">フォローリスト</a></li>
          </ul>
        </nav>
      </div>

      <div class="follow-info">
        フォロワー数 {{ Auth::user()->followerCount() }}人
      </div>

      <!-- フォロワーリスト -->
      <div class="list-header">
        <nav>
          <ul>
            <li><a href="{{ route('follower.list') }}">フォロワーリスト</a></li>
          </ul>
        </nav>
      </div>

      <!-- ユーザー検索ボタン -->
      <p class="user-search-btn">
        <a href="{{ route('users.search') }}">ユーザー検索</a>
      </p>
    </div> <!-- side-bar 終了 -->
  </div> <!-- row 終了 -->

  <footer></footer>

  <!-- JavaScriptファイル -->
  <script src="{{ asset('js/app.js') }}"></script>
  <script src="{{ asset('js/script.js') }}"></script>
  <script src="{{ asset('js/edit-modal.js') }}"></script>
</body>

</html>
