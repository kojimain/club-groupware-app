@extends('layouts.app')

@section('content')
<main>
    <section class="hero is-light is-fullheight">
        <div class="hero-body">
            <div class="container has-text-centered">
                <div class="column is-4 is-offset-4">
                    <img src="{{ asset('img/logo.png') }}" width="96" height="96" />
                    <div class="box">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="field">
                                <div class="control">
                                    <input
                                    class="input"
                                    type="email"
                                    name="email"
                                    value="{{ old('email') }}"
                                    placeholder="Email"
                                    autofocus
                                    />
                                </div>
                                @if ($errors->has('email'))
                                <p class="help is-danger">
                                    {{ $errors->first('email') }}
                                </p>
                                @endif
                            </div>
                            <div class="field">
                                <div class="control">
                                    <input
                                    class="input"
                                    type="password"
                                    name="password"
                                    placeholder="Password"
                                    />
                                </div>
                                @if ($errors->has('password'))
                                <p class="help is-danger">
                                    {{ $errors->first('password') }}
                                </p>
                                @endif
                            </div>
                            <div class="field">
                                <label class="checkbox">
                                    <input type="checkbox" />
                                    ログイン状態を記憶する
                                </label>
                            </div>
                            <button class="button is-block is-info is-large is-fullwidth">
                                Login
                            </button>
                        </form>
                    </div>
                    <p class="has-text-grey">
                        <a href="/register">新規登録</a>
                    </p>
                    <p class="has-text-grey">
                        <a href="/password/reset">パスワードをお忘れの方</a>
                    </p>
                </div>
            </div>
        </div>
    </section>
</main>

<footer class="footer">
    <div class="container">
        <div class="content has-text-centered">
            <p>
                (c) 2019 ClubGroupware(仮)
            </p>
        </div>
    </div>
</footer>
@endsection
