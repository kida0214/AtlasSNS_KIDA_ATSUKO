<x-logout-layout>
    <!-- 適切なURLを入力してください -->
{!! Form::open(['url' => 'register']) !!}
<div class="login-form">
    <p class="welcome-text">新規ユーザー登録</p>
    <div class="form-group">
{{ Form::label('ユーザー名') }}
{{ Form::text('username',null,['class' => 'input']) }}
    @error('username')
        <div class="error">{{ $message }}</div>
    @enderror

{{ Form::label('メールアドレス') }}
{{ Form::email('email',null,['class' => 'input']) }}
    @error('email')
        <div class="error">{{ $message }}</div>
    @enderror

    {{ Form::label('パスワード') }}
    {{ Form::password('password', ['class' => 'input']) }} <!-- ここで伏字に -->
    @error('password')
        <div class="error">{{ $message }}</div>
    @enderror

    {{ Form::label('パスワード確認') }}
    {{ Form::password('password_confirmation', ['class' => 'input']) }} <!-- ここで伏字に -->
    @error('password_confirmation')
        <div class="error">{{ $message }}</div>
    @enderror
{{ Form::submit('新規登録', ['class' => 'submit-button']) }}
<p><a href="login" class="register-link">ログイン画面へ戻る</a></p>
</div>
{!! Form::close() !!}


</x-logout-layout>
