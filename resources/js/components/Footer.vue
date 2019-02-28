<template>
  <footer class="footer">
    <div class="container">
      <div class="content has-text-centered">
        <p>
          (c) 2019 {{ appName }}
        </p>
      </div>
    </div>
  </footer>
</template>

<script>
import variables from "@/variables";

export default {
  data() {
    return {
      appName: variables.appName
    }
  }
};
</script>
