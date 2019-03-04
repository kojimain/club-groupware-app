<template>
  <div class="container">
    <section class="section">
      <h2 class="subtitle">クラブ編集</h2>
      <div class="box">
        <form @submit.prevent="submit">
          <div class="field">
            <p class="control">
              <label class="label">クラブ名</label>
              <input
                v-model="club.name"
                class="input"
                type="text"
                value="サンプルクラブ1"
                placeholder="Name"
              />
            </p>
            <FieldNotification
              v-if="errors.name"
              type="danger"
              :text="errors.name"/>
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
    <section class="section">
      <h2 class="subtitle">削除</h2>
      <div class="box is-clearfix">
        <div class="buttons is-pulled-right">
          <DeleteClubButton
            :club="club"/>
        </div>
      </div>
    </section>
  </div>
</template>

<script>
import DeleteClubButton from "@/components/DeleteClubButton";
import FieldNotification from "@/components/FieldNotification";

export default {
  components: {
    DeleteClubButton,
    FieldNotification
  },
  data() {
    return {
      club: {
        id: null,
        name: null
      },
      errors: {
        name: null
      }
    };
  },
  mounted() {
    this.fetchClub();
  },
  methods: {
    fetchClub() {
      axios.get(`/api/clubs/${this.$route.params.club_id}`)
        .then(response => {
          this.club = response.data;
        });
    },
    submit() {
      this.flushNotifications();
      axios
        .patch(`/api/clubs/${this.club.id}`, {
          name: this.club.name
        })
        .then(response => {
          this.$store.dispatch('flash/update', {type: 'is-primary', message: '更新しました'});
          const clubId = response.data.id;
          this.$router.push(`/clubs/${clubId}`);
        })
        .catch(error => {
          const errorMessage = error.response.status === 422 ? '更新できませんでした' : '通信エラーが発生しました';
          this.$store.dispatch('flash/update', {type: 'is-danger', message: errorMessage});
          this.errors = {
            name: (error.response.data.errors.name || [])[0]
          };
        });
    },
    flushNotifications() {
      this.errors = {
        name: null
      };
    }
  }
};
</script>
