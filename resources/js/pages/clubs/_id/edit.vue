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
          <div class="field">
            <p class="control">
              <label class="label">メンバー</label>
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

<script>
import Multiselect from "vue-multiselect";
import "vue-multiselect/dist/vue-multiselect.min.css";

export default {
  components: {
    Multiselect
  },
  data() {
    return {
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
