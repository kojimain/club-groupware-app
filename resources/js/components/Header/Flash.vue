<template>
  <div
    v-if="message"
    class="notification"
    :class="type">
    {{ message }}
  </div>
</template>

<script>
export default {
  computed: {
    type() {
      return this.$store.state.flash.type;
    },
    message() {
      return this.$store.state.flash.message;
    }
  },
  mounted() {
    this.$store.dispatch("flash/clear");
  }
}
</script>

<style scoped>
.notification {
  animation-name: fadeout;
  animation-delay: 2s;
  animation-duration: 0.5s;
  animation-timing-function: ease;
  animation-fill-mode: forwards;
}
@keyframes fadeout {
	0% {
		opacity: 1;
	}
	100% {
		opacity: 0;
	}
}
</style>
