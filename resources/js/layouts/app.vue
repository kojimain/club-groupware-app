<template>
  <div id="wrap">
    <Header />
    <main>
      <RouterView />
    </main>
    <Footer />
  </div>
</template>

<script>
import Header from "@/components/Header";
import Footer from "@/components/Footer";

export default {
  components: {
    Header,
    Footer
  }
};
</script>

<style scoped>
/* sticky footer // */
#wrap {
  display: flex;
  min-height: 100vh;
  flex-direction: column;
}
main {
  flex: 1;
}
/* // sticky footer */
</style>
