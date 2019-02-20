<template>
  <article class="list-item">
    <div class="column">
      {{ event.title }}
    </div>
    <div class="column is-clearfix">
      <div class="buttons is-pulled-left">
        <a class="button" @click="showEventModal = true">
          <span class="icon is-small">
            <i class="fas fa-info-circle"></i>
          </span>
        </a>
        <router-link to="/clubs/123/events/123/edit" class="button">
          <span class="icon is-small">
            <i class="fas fa-pen"></i>
          </span>
        </router-link>
      </div>
      <div class="buttons is-pulled-right">
        <a
          class="button is-primary"
          :class="{ 'is-outlined': !isAttendance }"
          @click="toggleAttendance()"
        >
          <span class="icon is-medium">
            <i class="fas fa-user-check"></i>
          </span>
        </a>
        <a
          class="button is-danger"
          :class="{ 'is-outlined': !isAbsence }"
          @click="toggleAbsence()"
        >
          <span class="icon is-medium">
            <i class="fas fa-ban"></i>
          </span>
        </a>
      </div>
    </div>
    <Modal
      :class="{ 'is-active': showEventModal }"
      @close="showEventModal = false"
    >
      <div slot="modal-content">
        <div class="box is-clearfix">
          <h3 class="subtitle">{{ event.title }}</h3>
          <p class="content">
            {{ event.body }}
          </p>
        </div>
      </div>
    </Modal>
  </article>
</template>

<script>
import Modal from "@/components/Modal";

export default {
  props: {
    event: {
      type: Object,
      default() {}
    }
  },
  components: {
    Modal
  },
  data() {
    return {
      showEventModal: false
    };
  },
  computed: {
    isAttendance() {
      return this.event.answer === "attendance";
    },
    isAbsence() {
      return this.event.answer === "absence";
    }
  },
  methods: {
    toggleAttendance() {
      const ans = this.event.answer !== "attendance" ? "attendance" : "pending";
      this.setAnswer(ans);
    },
    toggleAbsence() {
      const ans = this.event.answer !== "absence" ? "absence" : "pending";
      this.setAnswer(ans);
    },
    setAnswer(ans) {
      // mutation
      // TODO

      // set ans to this.event
      this.event.answer = `${ans}`;
    }
  }
};
</script>
