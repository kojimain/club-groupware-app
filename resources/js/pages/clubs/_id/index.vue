<template>
  <div class="container">
    <section class="section">
      <div class="columns is-centered">
        <div class="column is-9">
          <div class="card">
            <div class="card-header">
              <h3 class="card-header-title">イベント一覧</h3>
            </div>
            <div class="card-content">
              <div class="content is-clearfix">
                <div class="buttons is-pulled-right">
                  <router-link
                    to="/clubs/123/events/new"
                    class="button is-primary"
                  >
                    <span class="icon is-medium">
                      <i class="fas fa-envelope"></i>
                    </span>
                    <span>新規イベント作成</span>
                  </router-link>
                </div>
              </div>
              <div class="list">
                <Event v-for="event in events" :key="event.id" :event="event" />
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script>
import Event from "@/components/clubs/_id/index/Event";

export default {
  components: {
    Event
  },
  data() {
    return {
      events: [
        {
          id: 5,
          title: "イベント5タイトル55555555555",
          body: "イベント5本文55555\n55555",
          answer: "absence"
        },
        {
          id: 4,
          title: "イベント4タイトル44444444444",
          body: "イベント4本文44444\n44444",
          answer: "attendance"
        },
        {
          id: 3,
          title: "イベント3タイトル33333333333",
          body: "イベント3本文33333\n33333",
          answer: "pending"
        },
        {
          id: 2,
          title: "イベント2タイトル22222222222",
          body: "イベント2本文22222\n22222",
          answer: "pending"
        },
        {
          id: 1,
          title: "イベント1タイトル11111111111",
          body: "イベント1本文11111\n11111",
          answer: "pending"
        }
      ]
    };
  }
};
</script>
