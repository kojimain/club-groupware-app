<template>
  <div class="container">
    <section class="section">
      <h2 class="subtitle">新規クラブ作成</h2>
      <div class="box">
        <form @submit.prevent="submit">
          <div class="field">
            <p class="control">
              <label class="label">クラブ名</label>
              <input
                v-model="club.name"
                class="input"
                type="text"
                name="name"
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
              <button class="button is-primary">作成</button>
            </div>
          </div>
        </form>
      </div>
    </section>
  </div>
</template>

<script>
import FieldNotification from "@/components/FieldNotification";

export default {
  components: {
    FieldNotification
  },
  data() {
    return {
      club: {
        name: null
      },
      errors: {
        name: null
      }
    };
  },
  methods: {
    submit() {
      this.flushNotifications();
      axios
        .post('/api/clubs', {
          name: this.club.name
        })
        .then(response => {
          this.$store.dispatch('flash/update', {type: 'is-primary', message: '作成しました'});
          const clubId = response.data.id;
          this.$router.push(`/clubs/${clubId}`);
        })
        .catch(error => {
          const errorMessage = error.response.status === 422 ? '作成できませんでした' : '通信エラーが発生しました';
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
