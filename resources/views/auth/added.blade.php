<x-logout-layout>
   <div class="login-form">
<p class="new-text">
    {{ session('user_name') }}さん<br>ようこそ！AtlasSNSへ！
</p>
<p class="new-user">ユーザー登録が完了いたしました。<br>早速ログインをしてみましょう！</p>

<!-- ログイン画面へのリンクをボタン風に表示 -->
<a href="{{ route('login') }}" class="login-button">ログイン画面へ</a>

</div>
{!! Form::close() !!}

</x-logout-layout>
