<x-login-layout>
    <!-- ユーザーのアイコン -->
    <div class="profile-list">
        <div class="profile-content">
            <div class="profile-main">
                <img src="{{ asset($user->icon_image) }}" alt="{{ $user->username }}のアイコン" class="icon-img">
                <div class="profile-text">
                    <div class="profile-row">
                        <p class="profile-label">ユーザー名</p>
                        <p class="profile-value username">{{ $user->username }}</p>
                    </div>
                    <div class="profile-row">
                        <p class="profile-label">自己紹介</p>
                        <p class="profile-value bio">{{ old('bio', $user->bio) }}</p>
                    </div>
                </div>
            </div>

            <!-- フォローボタン -->
            <div class="follow-action">
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
        </div>
    </div>

    <!-- 投稿一覧 -->
    <div class="posts-grid">
        @foreach ($posts as $post)
            <div class="post">
                <div class="post-header">
                    <!-- 投稿者のアイコン -->
                    <a href="{{ route('profile.show', $post->user->id) }}">
                        <img src="{{ asset($post->user->icon_image) }}" alt="アイコン" class="icon-img">
                    </a>
                    <!-- ユーザー名 -->
                    <p class="username">{{ $post->user->username }}</p>
                    <!-- 投稿日 -->
                    <p class="post-date">{{ $post->created_at->format('Y-m-d H:i') }}</p>
                </div>
                <!-- 投稿内容 -->
                <p class="post-content">{!! nl2br(e($post->post)) !!}</p>
            </div>
        @endforeach
    </div>
</x-login-layout>
