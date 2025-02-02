<x-logout-layout>

  <!-- 適切なURLを入力してください -->
 {!! Form::open(['url' => 'login']) !!}

  <!-- <div class="login-form"> -->
<p>AtlasSNSへようこそ</p>

	<!-- <div class="form-group"> -->
  {{ Form::label('email') }}
  {{ Form::text('email', null, ['class' => 'input', 'required' => true, 'autofocus' => true]) }}

  {{ Form::label('password') }}
  {{ Form::password('password', ['class' => 'input', 'required' => true]) }}

  {{ Form::submit('ログイン') }}
	<!-- </div> -->
  <p><a href="/register">新規ユーザーの方はこちら</a></p>
<!-- </div> -->
  {!! Form::close() !!}

</x-logout-layout>
