<template>
  <div class="container">
    <section class="section">
      <div class="columns is-centered">
        <div class="column is-9">
          <h2 class="subtitle">Dashboard</h2>
          <!-- messages // -->
          <div class="content">
            <article class="message is-primary">
              <div class="message-header">
                <p>「サンプルクラブ4」から招待が届いています</p>
              </div>
              <div class="message-body is-clearfix">
                <div class="buttons is-pulled-right">
                  <a class="button is-primary">
                    <span class="icon is-medium">
                      <i class="fas fa-user-check"></i>
                    </span>
                    <span>参加する</span>
                  </a>
                  <a class="button">
                    <span class="icon is-medium">
                      <i class="fas fa-ban"></i>
                    </span>
                    <span>辞退する</span>
                  </a>
                </div>
              </div>
            </article>
          </div>
          <!-- // messages -->
          <!-- clubs // -->
          <div class="content">
            <div class="columns is-centered is-multiline">
              <div v-for="club in clubs" :key="club.id" class="column is-4">
                <router-link :to="`/clubs/${club.id}`">
                  <div class="card">
                    <div class="card-content">
                      {{ club.name }}
                    </div>
                  </div>
                </router-link>
              </div>
            </div>
          </div>
          <!-- // clubs -->
        </div>
      </div>
    </section>
  </div>
</template>

<script>
export default {
  computed: {
    clubs() {
      return this.$store.state.club.clubs;
    }
  }
};
</script>

<style scoped>
a .card :hover {
  box-shadow: 0px 6px 6px 0px #dddddd;
}
</style>
