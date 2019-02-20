<template>
  <div class="container">
    <section class="section">
      <h2 class="subtitle">イベント編集</h2>
      <div class="box">
        <form action="/clubs/123">
          <div class="field">
            <p class="control">
              <label class="label">タイトル</label>
              <input
                class="input"
                type="text"
                value="イベント1タイトル11111111111"
                placeholder="Title"
              />
            </p>
          </div>
          <div class="field">
            <p class="control">
              <label class="label">本文</label>
              <textarea class="textarea" type="text" placeholder="Body" />
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
