<template>
  <div class="container">
    <section class="section">
      <h2 class="subtitle">プロフィール編集</h2>
      <div class="box">
        <form action="/">
          <div class="field">
            <p class="control">
              <label class="label">お名前</label>
              <input
                class="input"
                type="text"
                value="サンプルメンバー1"
                placeholder="Name"
              />
            </p>
          </div>
          <div class="field">
            <p class="control">
              <label class="label">Email</label>
              <input
                class="input"
                type="email"
                value="sample1@example.com"
                placeholder="Email"
              />
            </p>
          </div>
          <hr />
          <div class="field is-grouped">
            <div class="control">
              <button class="button is-primary">更新</button>
            </div>
          </div>
        </form>
      </div>
    </section>
  </div>
</template>
