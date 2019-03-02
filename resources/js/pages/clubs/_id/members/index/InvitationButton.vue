<template>
  <div>
    <a class="button is-primary" @click="isActive = true">
      <span class="icon is-medium">
        <i class="fas fa-envelope"></i>
      </span>
      <span>招待</span>
    </a>
    <Modal
      :class="{ 'is-active': isActive }"
      @close="isActive = false"
    >
      <div slot="modal-content">
        <div class="box is-clearfix">
          <h3 class="subtitle">招待する</h3>
          <p class="content">
            選択したフレンドにクラブへの招待を送ります。
          </p>
          <form>
            <div class="field">
              <p class="control">
                <Multiselect
                  v-model="selectedFriends"
                  :options="friends"
                  label="name"
                  track-by="id"
                  open-direction="bottom"
                  :close-on-select="false"
                  :show-labels="false"
                  placeholder=""
                  multiple
                >
                  <span slot="noResult">(該当なし)</span>
                </Multiselect>
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
  </div>
</template>

<script>
import Modal from "@/components/Modal";
import Multiselect from "vue-multiselect";
import "vue-multiselect/dist/vue-multiselect.min.css";

export default {
  components: {
    Modal,
    Multiselect
  },
  data() {
    return {
      isActive: false,
      friends: [
        { id: 1, name: "サンプルフレンド1" },
        { id: 2, name: "サンプルフレンド2" },
        { id: 3, name: "サンプルフレンド3" },
        { id: 4, name: "サンプルフレンド4" },
        { id: 5, name: "サンプルフレンド5" },
        { id: 6, name: "サンプルフレンド6" }
      ],
      selectedFriendIds: [2, 3]
    };
  },
  computed: {
    selectedFriends: {
      get() {
        return this.friends.filter(friend => {
          return this.selectedFriendIds.includes(friend.id);
        });
      },
      set(friends) {
        this.selectedFriendIds = friends.map(friend => {
          return friend.id;
        });
      }
    }
  }
};
</script>
