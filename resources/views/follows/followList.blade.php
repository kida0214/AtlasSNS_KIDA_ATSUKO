<x-login-layout>
  <div class="follow-list">
    <div class="title">
      フォローリスト
    </div>
    <!-- フォローしているユーザーのアイコンを表示 -->
    <div class="follow-icons-grid">
      @foreach ($followingUsers as $followedUser)
        <div class="user-card">
          <!-- ユーザーのプロフィールページへのリンクを追加 -->
          <a href="{{ route('profile.show', $followedUser->id) }}">
            <img src="{{ asset($followedUser->icon_image) }}" alt="アイコン" class="icon-img">
          </a>
        </div>
      @endforeach
    </div>
  </div>

  <!-- フォローユーザーの投稿を表示 -->
  <div class="posts-grid">
    @foreach ($followedPosts as $post)
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
