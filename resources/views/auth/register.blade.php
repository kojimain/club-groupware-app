@extends('layouts.app')

@section('content')
<main>
    <section class="hero is-light is-fullheight">
        <div class="hero-body">
            <div class="container has-text-centered">
                <div class="column is-4 is-offset-4">
                    <img src="/img/logo.png" width="96" height="96" />
                    <div class="box">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="field">
                                <div class="control">
                                    <label class="label">{{ __('validation.attributes.name') }}</label>
                                    <input
                                    class="input"
                                    type="text"
                                    name="name"
                                    value="{{ old('name') }}"
                                    placeholder="Name"
                                    autofocus
                                    required
                                    />
                                </div>
                                @if ($errors->has('name'))
                                <p class="help is-danger">
                                    {{ $errors->first('name') }}
                                </p>
                                @endif
                            </div>
                            <div class="field">
                                <div class="control">
                                    <label class="label">{{ __('validation.attributes.email') }}</label>
                                    <input
                                    class="input"
                                    type="email"
                                    name="email"
                                    value="{{ old('email') }}"
                                    placeholder="Email"
                                    required
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
                                    <label class="label">{{ __('validation.attributes.password') }}</label>
                                    <input
                                    class="input"
                                    type="password"
                                    name="password"
                                    placeholder="Password"
                                    required
                                    />
                                </div>
                                @if ($errors->has('password'))
                                <p class="help is-danger">
                                    {{ $errors->first('password') }}
                                </p>
                                @endif
                            </div>
                            <div class="field">
                                <div class="control">
                                    <label class="label">{{ __('validation.attributes.password') }}(確認)</label>
                                    <input
                                    class="input"
                                    type="password"
                                    name="password_confirmation"
                                    placeholder="Password"
                                    />
                                </div>
                                @if ($errors->has('password_confirmation'))
                                <p class="help is-danger">
                                    {{ $errors->first('password_confirmation') }}
                                </p>
                                @endif
                            </div>
                            <button
                            class="button is-block is-primary is-large is-fullwidth"
                            >
                            登録
                        </button>
                    </form>
                </div>
                <p class="has-text-grey">
                    <a href="/login">ログインページに戻る</a>
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
                (c) 2019 {{ env('APP_NAME') }}
            </p>
        </div>
    </div>
</footer>
@endsection
