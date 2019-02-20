@extends('layouts.app')

@section('content')
<main>
  <section class="hero is-light is-fullheight">
    <div class="hero-body">
      <div class="container has-text-centered">
        <div class="column is-4 is-offset-4">
          <img src="/img/logo.png" width="96" height="96" />
          <div class="box">
            <form action="/login">
              <div class="field">
                <div class="control">
                  <label class="label">メールアドレス</label>
                  <input
                    class="input"
                    type="email"
                    placeholder="Email"
                    autofocus
                  />
                </div>
              </div>
              <div class="field">
                <div class="control">
                  <label class="label">パスワード</label>
                  <input
                    class="input"
                    type="password"
                    placeholder="Password"
                  />
                </div>
              </div>
              <div class="field">
                <div class="control">
                  <label class="label">パスワード(確認)</label>
                  <input
                    class="input"
                    type="password"
                    placeholder="Password"
                  />
                </div>
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
                (c) 2019 ClubGroupware(仮)
            </p>
        </div>
    </div>
</footer>
@endsection
