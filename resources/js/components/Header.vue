<template>
  <header>
    <nav class="navbar is-fixed-top">
      <div class="navbar-brand">
        <router-link to="/" class="navbar-item">
          <img src="/img/logo.png" />
          <span>ClubGroupware(仮)</span>
        </router-link>
        <span
          class="navbar-burger burger"
          data-target="navbarMenu"
          @click="toggleMenu()"
        >
          <span></span>
          <span></span>
          <span></span>
        </span>
      </div>
      <div
        id="navbarMenu"
        class="navbar-menu"
        :class="{
          'is-active': isMenuActive
        }"
      >
        <slot name="navbar-start"></slot>
        <div class="navbar-end">
          <div class="navbar-item has-dropdown is-hoverable">
            <a class="navbar-link">
              サンプルメンバー1
            </a>
            <div class="navbar-dropdown">
              <router-link to="/edit" class="navbar-item">
                プロフィール編集
              </router-link>
              <hr class="navbar-divider" />
              <a
                class="navbar-item"
                @click="logout">
                ログアウト
              </a>
            </div>
          </div>
        </div>
      </div>
      <Flash class="flash"/>
    </nav>
  </header>
</template>

<script>
import Flash from "./Header/Flash";

export default {
  components: {
    Flash
  },
  data() {
    return {
      isMenuActive: false
    };
  },
  methods: {
    toggleMenu() {
      this.isMenuActive = !this.isMenuActive;
    },
    logout() {
      // /logout へPOSTするフォームエレメントを作ってsubmitする

      // <form>
      const logoutForm = document.createElement("form");
      logoutForm.method = "POST";
      logoutForm.action = "/logout";
      document.body.appendChild(logoutForm);
      // CSRFトークンの<input>
      const csrfTokenInput = document.createElement("input");
      csrfTokenInput.name = "_token";
      csrfTokenInput.value = document.head.querySelector('meta[name="csrf-token"]').content;
      logoutForm.appendChild(csrfTokenInput);
      // POST実行
      logoutForm.submit();
    }
  }
};
</script>

<style scoped>
header {
  margin-bottom: 60px;
}
.flash {
  position: fixed;
  top: 52px;
  width: 100%;
}
</style>
