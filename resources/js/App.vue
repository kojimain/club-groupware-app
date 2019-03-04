<template>
  <RouterView />
</template>

<script>
export default {
  mounted() {
    this.$store.dispatch('profile/fetch');
  }
};
</script>
