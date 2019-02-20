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
                v-model="selectedMembers"
                :options="members"
                label="name"
                track-by="id"
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
      members: [
        { id: 2, name: "サンプルメンバー2" },
        { id: 3, name: "サンプルメンバー3" },
        { id: 4, name: "サンプルメンバー4" }
      ],
      selectedMemberIds: [2, 3]
    };
  },
  computed: {
    selectedMembers: {
      get() {
        return this.members.filter(member => {
          return this.selectedMemberIds.includes(member.id);
        });
      },
      set(members) {
        this.selectedMemberIds = members.map(member => {
          return member.id;
        });
      }
    }
  }
};
</script>
