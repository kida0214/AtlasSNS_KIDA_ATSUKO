<x-login-layout>
    <div class="profile-header">
        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <div class="form-left">
                    <img src="{{ asset(Auth::user()->icon_image) }}" alt="icon" class="icon-img">
                </div>
                <div class="form-right">
                    <div class="form-row">
                        <label for="username">ユーザー名</label>
                        <input type="text" name="username" value="{{ old('username', $user->username) }}">
                    </div>
                    <div class="form-row">
                        <label for="email">メールアドレス</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}">
                    </div>
                    <div class="form-row">
                        <label for="password">新しいパスワード</label>
                        <input type="password" name="password" id="password" placeholder="新しいパスワード" autocomplete="new-password">
                    </div>
                    <div class="form-row">
                        <label for="password_confirmation">パスワード確認</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" placeholder="確認用パスワード" autocomplete="new-password">
                    </div>
                    <div class="form-row">
                        <label for="bio">自己紹介</label>
                        <textarea name="bio" class="bio-input">{{ old('bio', $user->bio) }}</textarea>
                    </div>
                    <div class="form-rows">
                        <label for="icon_image">アイコン画像</label>
                        <input type="file" name="icon_image" class="file-input">
                    </div>
                </div>
            </div>
            <button type="submit" class="update-btn">更新</button>
        </form>
    </div>
</x-login-layout>
