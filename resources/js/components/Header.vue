<template>
  <header>
    <nav class="navbar is-fixed-top">
      <div class="navbar-brand">
        <router-link to="/" class="navbar-item">
          <img src="/img/logo.png" />
          <span>{{ appName }}</span>
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
        <div class="navbar-start">
          <div class="navbar-item has-dropdown is-hoverable">
            <router-link
              :to="currentClub ? `/clubs/${currentClub.id}` : '/'"
              class="navbar-link">
              {{ currentClub ? currentClub.name : 'クラブ選択' }}
            </router-link>
            <div class="navbar-dropdown">
              <router-link
                v-for="club in clubs"
                :key="club.id"
                :to="`/clubs/${club.id}`"
                class="navbar-item"
                :class="{'is-active': currentClub === club}">
                {{ club.name }}
              </router-link>
              <router-link to="/clubs/new" class="navbar-item">
                新規クラブ作成
              </router-link>
              <div v-if="currentClub">
                <hr class="navbar-divider" />
                <router-link
                  :to="`/clubs/${currentClub.id}/members`"
                  class="navbar-item">
                  メンバー一覧
                </router-link>
                <router-link
                  :to="`/clubs/${currentClub.id}/edit`"
                  class="navbar-item">
                  クラブ編集
                </router-link>
              </div>
            </div>
          </div>
        </div>
        <div class="navbar-end">
          <div class="navbar-item has-dropdown is-hoverable">
            <a class="navbar-link">
              サンプルメンバー1
            </a>
            <div class="navbar-dropdown">
              <router-link to="/edit" class="navbar-item">
                プロフィール編集
              </router-link>
              <router-link to="/friends" class="navbar-item">
                フレンド一覧
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
import variables from "@/variables";
import Flash from "./Header/Flash";

export default {
  components: {
    Flash
  },
  data() {
    return {
      appName: variables.appName,
      isMenuActive: false,
      clubs: []
    };
  },
  mounted() {
    this.fetchClubs();
  },
  watch: {
    '$route'() {
      this.fetchClubs();
    }
  },
  computed: {
    currentClub() {
      return this.clubs.find(club => { return `${club.id}` === this.$route.params.club_id; });
    }
  },
  methods: {
    fetchClubs() {
      axios.get('/api/clubs')
        .then(response => {
          this.clubs = response.data.sort((a, b) => { return a.id - b.id; });
        });
    },
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
