<x-login-layout>
    <div class="profile-header">
        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- バリデーションエラー --}}
            @if ($errors->any())
                <div class="error-messages">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <div class="form-group">
                {{-- 左：アイコン表示 --}}
                <div class="form-left">
                    <img src="{{ asset(Auth::user()->icon_image) }}" alt="icon" class="icon-img">
                </div>

                {{-- 右：フォーム入力欄 --}}
                <div class="form-right">
                    {{-- ユーザー名 --}}
                    <div class="form-row">
                        <label for="username">ユーザー名</label>
                        <input type="text" name="username" id="username" value="{{ old('username', $user->username) }}">
                    </div>

                    {{-- メールアドレス --}}
                    <div class="form-row">
                        <label for="email">メールアドレス</label>
                        <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}">
                    </div>

                    {{-- パスワード --}}
                    <div class="form-row">
                        <label for="password">新しいパスワード</label>
                        <input type="password" name="password" id="password" placeholder="新しいパスワード" autocomplete="new-password">
                    </div>

                    {{-- パスワード確認 --}}
                    <div class="form-row">
                        <label for="password_confirmation">パスワード確認</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" placeholder="確認用パスワード" autocomplete="new-password">
                    </div>

                    {{-- 自己紹介 --}}
                    <div class="form-row">
                        <label for="bio">自己紹介</label>
                        <textarea name="bio" id="bio" class="bio-input">{{ old('bio', $user->bio) }}</textarea>
                    </div>

                    {{-- アイコン画像アップロード --}}
                    <div class="form-row">
                        <label for="icon_image">アイコン画像</label>
                        <div class="file-upload">
                            <label for="icon_image" id="custom-label">ファイルを選択</label>
                            <input type="file" id="icon_image" name="icon_image" accept="image/*">
                        </div>
                    </div>
                </div>
            </div>

            {{-- 更新ボタン --}}
            <div class="form-submit">
                <button type="submit" class="update-btn">更新</button>
            </div>
        </form>
    </div>
</x-login-layout>
