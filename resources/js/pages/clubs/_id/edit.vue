<template>
  <div class="container">
    <section class="section">
      <h2 class="subtitle">クラブ編集</h2>
      <div class="box">
        <form action="/clubs/123">
          <div class="field">
            <p class="control">
              <label class="label">クラブ名</label>
              <input
                class="input"
                type="text"
                value="サンプルクラブ1"
                placeholder="Name"
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
