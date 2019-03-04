<template>
  <div
    v-if="profile"
    class="container">
    <section class="section">
      <h2 class="subtitle">プロフィール編集</h2>
      <div class="box">
        <form @submit.prevent="updateProfile">
          <div class="field">
            <p class="control">
              <label class="label">お名前</label>
              <input
                v-model="profileForm.name"
                class="input"
                type="text"
                placeholder="Name"
              />
            </p>
            <FieldNotification
              v-if="errors.name"
              type="danger"
              :text="errors.name"/>
          </div>
          <div class="field">
            <p class="control">
              <label class="label">Email</label>
              <input
                v-model="profileForm.email"
                class="input"
                type="email"
                placeholder="Email"
              />
              <FieldNotification
                v-if="errors.email"
                type="danger"
                :text="errors.email"/>
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
import FieldNotification from "@/components/FieldNotification";

export default {
  components: {
    FieldNotification
  },
  data() {
    return {
      editProfile: null,
      errors: {
        name: null,
        email: null
      }
    }
  },
  computed: {
    profile() {
      return this.$store.state.profile;
    },
    profileForm() {
      return Object.assign({}, this.profile);
    }
  },
  methods: {
    updateProfile() {
      this.flushNotifications();
      this.$store.dispatch('profile/update', this.profileForm)
        .then(response => {
          this.$store.dispatch('flash/update', {type: 'is-primary', message: '更新しました'});
        })
        .catch(error => {
          const errorMessage = error.response.status === 422 ? '更新できませんでした' : '通信エラーが発生しました';
          this.$store.dispatch('flash/update', {type: 'is-danger', message: errorMessage});
          this.errors = {
            name: (error.response.data.errors.name || [])[0],
            email: (error.response.data.errors.email || [])[0]
          };
        });
    },
    flushNotifications() {
      this.errors = {
        name: null,
        email: null
      };
    }
  }
};
</script>
