<template>
  <div class="container">
    <section class="section">
      <div class="columns is-centered">
        <div class="column is-9">
          <h2 class="subtitle">メンバー一覧</h2>
          <!-- invite -->
          <div class="buttons is-pulled-right">
            <a class="button is-primary" @click="showInvitationModal = true">
              <span class="icon is-medium">
                <i class="fas fa-envelope"></i>
              </span>
              <span>招待</span>
            </a>
          </div>
          <Modal
            :class="{ 'is-active': showInvitationModal }"
            @close="showInvitationModal = false"
          >
            <div slot="modal-content">
              <div class="box is-clearfix">
                <h3 class="subtitle">招待する</h3>
                <p class="content">
                  入力したメールアドレス宛に招待メールを送信します。
                </p>
                <form>
                  <div class="field">
                    <p class="control">
                      <input
                        class="input"
                        type="email"
                        value=""
                        placeholder="Email"
                      />
                    </p>
                  </div>
                  <div class="field is-grouped is-pulled-right">
                    <div class="control">
                      <button class="button is-primary">送信</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </Modal>
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
import Modal from "@/components/Modal";

export default {
  components: {
    Modal
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
      query: "",
      showInvitationModal: false
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
