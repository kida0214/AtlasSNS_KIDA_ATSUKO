<x-logout-layout>

  <!-- 適切なURLを入力してください -->
 {!! Form::open(['url' => route('login')]) !!}

  <!-- <div class="login-form"> -->
<div class="login-form"> <!-- 親要素を追加 -->
    <p class="welcome-text">AtlasSNSへようこそ</p>

    <div class="form-group">
        {{ Form::label('メールアドレス') }}
        {{ Form::text('email', null, ['class' => 'input', 'required' => true, 'autofocus' => true]) }}

        {{ Form::label('パスワード') }}
        {{ Form::password('password', ['class' => 'input', 'required' => true]) }}
        {{ Form::submit('ログイン', ['class' => 'submit-button']) }}
    </div>

    <p><a href="/register" class="register-link">新規ユーザーの方はこちら</a></p>
</div> <!-- login-form終了 -->
{!! Form::close() !!}
</x-logout-layout>
