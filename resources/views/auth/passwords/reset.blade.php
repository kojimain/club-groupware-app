@extends('layouts.app')

@section('content')
    <main>
        <section class="hero is-light is-fullheight">
            <div class="hero-body">
                <div class="container has-text-centered">
                    <div class="column is-4 is-offset-4">
                        <img src="/img/logo.png" width="96" height="96" />
                        <div class="box">
                            <form method="post" action="{{ route('password.update') }}">
                                @csrf
                                <input type="hidden" name="token" value="{{ $token }}">
                                <div class="field">
                                    <p>
                                        パスワード再発行
                                    </p>
                                </div>
                                <div class="field">
                                    <div class="control">
                                        <label class="label">{{ __('validation.attributes.email') }}</label>
                                        <input
                                        class="input"
                                        name="email"
                                        type="email"
                                        value="{{ old('email') }}"
                                        placeholder="Email"
                                        required
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
                                パスワード再発行
                            </button>
                        </form>
                    </div>
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
