<x-login-layout>
    <!-- バリデーションエラー -->
    @if ($errors->any())
        <div class="error-messages">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <div class="post-form-container">
        <!-- ユーザーアイコン -->
        <div>
            <img src="{{ asset(Auth::user()->icon_image) }}" alt="icon" class="icon-img">
        </div>

        <!-- 投稿フォーム -->
        <form action="{{ route('posts.store') }}" method="POST" class="post-form">
            @csrf
            <textarea name="post" class="form-control" placeholder="投稿内容を入力してください。" required></textarea>
            <button type="submit" class="post-button">
                <img src="{{ asset('images/post.png') }}" alt="投稿">
            </button>
        </form>
    </div>

    <!-- 投稿一覧 -->
    @foreach($posts as $post)
        <div class="post">
            <div class="post-header">
                <!-- 投稿者のアイコン -->
                <img src="{{ asset($post->user->icon_image) }}" alt="icon" class="icon-img">
                <!-- ユーザー名 -->
                <p class="username">{{ $post->user->username }}</p>
                <!-- 投稿日 -->
                <p class="post-date">{{ $post->created_at->format('Y-m-d H:i') }}</p>
            </div>
            <!-- 投稿内容 -->
            <p class="post-content">{!! nl2br(e($post->post)) !!}</p>

            @if(Auth::id() === $post->user_id)
                <div class="post-actions">
                    <!-- 編集ボタン -->
                    <button type="button" class="edit-btn" data-id="{{ $post->id }}" data-content="{{ $post->post }}">
                        <img src="{{ asset('images/edit.png') }}" alt="編集">
                    </button>

                    <!-- 削除ボタン -->
                    <button type="button" class="delete-icon" data-id="{{ $post->id }}"></button>
                </div>
            @endif
        </div>
    @endforeach

    <!-- 編集モーダル -->
    <div id="editModal" class="modal-edit">
        <div class="modal-box">
            <!-- 投稿編集フォーム -->
            <form id="editPostForm" method="POST" action="{{ route('posts.update', ['post' => ':id']) }}" class="edit-form">
                @csrf
                @method('PUT')
                <textarea name="post" id="editPostContent" class="edit-textarea"></textarea>
                <div class="modal-button">
                    <button type="submit" class="update-button">
                        <img src="{{ asset('images/edit.png') }}" alt="更新">
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- 削除確認モーダル -->
    <div id="deleteModal" class="modal-delete">
        <div class="modal-content">
            <div class="modal-text">
                この投稿を削除します。よろしいでしょうか？
            </div>
            <div class="modal-buttons">
                <!-- 削除確認フォーム -->
                <form id="deleteForm" action="" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" id="confirmDelete">OK</button>
                </form>
                <button id="cancelDelete">キャンセル</button>
            </div>
        </div>
    </div>
</x-login-layout>
