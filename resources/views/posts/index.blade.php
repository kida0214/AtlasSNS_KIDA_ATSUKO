<x-login-layout>

    <!-- 投稿フォーム -->
    <div class="post-form">
        <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
            @csrf <!-- CSRFトークンを含める -->

            <div class="form-group">
                <textarea id="content" name="content" class="form-control" placeholder="投稿内容を入力してください。" rows="5" required></textarea>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">
                    <div class="icon">
                        <img src="images/post.png" alt="icon" class="icon">
                    </div>
                </button>
            </div>
        </form>
    </div>

</x-login-layout>
