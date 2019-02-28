<template>
  <div class="container">
    <section class="section">
      <h2 class="subtitle">プロフィール編集</h2>
      <Notification
        v-if="notification.text"
        :type="notification.type"
        :text="notification.text"/>
      <div class="box">
        <form @submit.prevent="updateProfile">
          <div class="field">
            <p class="control">
              <label class="label">お名前</label>
              <input
                v-model="profile.name"
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
                v-model="profile.email"
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
import Notification from "@/components/Notification";
import FieldNotification from "@/components/FieldNotification";

export default {
  components: {
    Notification,
    FieldNotification
  },
  data() {
    return {
      profile: {},
      notification: {
        type: null,
        text: null
      },
      errors: {
        name: null,
        email: null
      }
    }
  },
  mounted() {
    this.fetchProfile();
  },
  methods: {
    fetchProfile() {
      axios
        .get('/api/profile')
        .then(response => {
          this.profile = {
            name: response.data.name,
            email: response.data.email,
          };
        });
    },
    updateProfile() {
      this.flushNotifications();
      axios
        .post('/api/profile', {
          name: this.profile.name,
          email: this.profile.email
        })
        .then(response => {
          this.notification = {
            type: 'primary',
            text: '更新しました'
          };
        })
        .catch(error => {
          this.notification = {
            type: 'danger',
            text: error.response.status === 422 ? '更新できませんでした' : '通信エラーが発生しました'
          };
          this.errors = {
            name: (error.response.data.errors.name || [])[0],
            email: (error.response.data.errors.email || [])[0]
          };
        });
    },
    flushNotifications() {
      this.notification = {
        type: null,
        text: null
      };
      this.errors = {
        name: null,
        email: null
      };
    }
  }
};
</script>
