<template>
  <Header>
    <div slot="navbar-start" class="navbar-start">
      <div class="navbar-item has-dropdown is-hoverable">
        <router-link to="/clubs/123" class="navbar-link">
          サンプルクラブ1
        </router-link>
        <div class="navbar-dropdown">
          <router-link to="/clubs/123" class="navbar-item is-active">
            サンプルクラブ1
          </router-link>
          <router-link to="/clubs/123" class="navbar-item">
            サンプルクラブ2
          </router-link>
          <router-link to="/clubs/123" class="navbar-item">
            サンプルクラブ3
          </router-link>
          <router-link to="/clubs/new" class="navbar-item">
            新規クラブ作成
          </router-link>
          <hr class="navbar-divider" />
          <router-link to="/clubs/123/members" class="navbar-item">
            メンバー一覧
          </router-link>
          <router-link to="/clubs/123/edit" class="navbar-item">
            クラブ編集
          </router-link>
        </div>
      </div>
    </div>
  </Header>
</template>

<script>
import Header from "@/components/Header";

export default {
  components: {
    Header
  }
};
</script>
