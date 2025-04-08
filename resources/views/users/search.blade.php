<x-login-layout>
    <div class="search-container">
        <div class="search-box">
            <form action="{{ route('users.search') }}" method="GET" class="search-form">
                <input type="text" name="query" value="{{ request('query') }}" placeholder="ユーザー名">

                <!-- 検索ボタン（画像を使用） -->
                <button type="submit" class="post-button">
                    <img src="{{ asset('images/search.png') }}" alt="検索" width="20">
                </button>
            </form>

            <!-- 検索ワードの表示（検索されたときのみ） -->
            @if(request('query'))
                <div class="search-word">検索ワード：{{ request('query') }}</div>
            @endif
        </div>
    </div>

    @if(isset($users) && $users->isNotEmpty())
        @foreach($users as $user)
            <div class="user">
                <!-- ユーザーアイコンを表示 -->
                <img src="{{ asset($user->icon_image) }}" alt="ユーザーアイコン" class="icon-img">

                <!-- ユーザー名を表示 -->
                <p class="username">{{ $user->username }}</p>

                <!-- フォロー・フォロー解除ボタン -->
                @if(auth()->user()->isFollowing($user->id))
                    <!-- すでにフォローしている場合は解除ボタン -->
                    <form action="{{ route('unfollow', $user->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="follow-btn unfollow">フォロー解除</button>
                    </form>
                @else
                    <!-- まだフォローしていない場合はフォローボタン -->
                    <form action="{{ route('follow', $user->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="follow-btn follow">フォローする</button>
                    </form>
                @endif
            </div>
        @endforeach
    @else
        <p class="no-results-message">該当するユーザーが見つかりませんでした。</p>
    @endif
</x-login-layout>
