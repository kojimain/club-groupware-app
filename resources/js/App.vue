<template>
  <RouterView />
</template>

<script>
export default {
  mounted() {
    this.$store.dispatch('profile/fetch');
    this.$store.dispatch('club/fetchClubs');
  }
};
</script>
