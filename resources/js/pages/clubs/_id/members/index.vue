<template>
  <div class="container">
    <section class="section">
      <div class="columns is-centered">
        <div class="column is-9">
          <h2 class="subtitle">メンバー一覧</h2>
          <!-- invite -->
          <div class="buttons is-pulled-right">
            <InvitationButton />
          </div>
          <!-- search -->
          <div class="content">
            <div class="control has-icons-left">
              <input
                class="input is-small"
                type="text"
                placeholder="search"
                v-model="query"
              />
              <span class="icon is-small is-left">
                <i class="fas fa-search" aria-hidden="true"></i>
              </span>
            </div>
          </div>
          <!-- list -->
          <div
            v-for="member in filteredMembers"
            :key="member.id"
            class="level is-mobile"
          >
            <div class="level-left">
              <p>{{ member.name }}</p>
            </div>
            <div class="level-right">
              <div class="buttons">
                <a class="button is-small is-danger">
                  <span class="icon is-medium">
                    <i class="fas fa-ban"></i>
                  </span>
                  <span>退会</span>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script>
import InvitationButton from "./index/InvitationButton";

export default {
  components: {
    InvitationButton
  },
  data() {
    return {
      members: [
        { id: 5, name: "サンプルメンバー5" },
        { id: 4, name: "サンプルメンバー4" },
        { id: 3, name: "サンプルメンバー3" },
        { id: 2, name: "サンプルメンバー2" },
        { id: 1, name: "サンプルメンバー1" }
      ],
      query: ""
    };
  },
  computed: {
    filteredMembers() {
      return this.members.filter(member => {
        return `${member.name}`.includes(`${this.query}`);
      });
    }
  }
};
</script>
