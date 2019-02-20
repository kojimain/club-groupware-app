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
              <a href="/login" class="navbar-item">
                ログアウト
              </a>
            </div>
          </div>
        </div>
      </div>
    </nav>
  </header>
</template>

<script>
export default {
  data() {
    return {
      isMenuActive: false
    };
  },
  methods: {
    toggleMenu() {
      this.isMenuActive = !this.isMenuActive;
    }
  }
};
</script>

<style scoped>
header {
  margin-bottom: 60px;
}
</style>
