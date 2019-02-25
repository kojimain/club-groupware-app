<template>
  <p
    class="help"
    :class="[`is-${type}`]">
      {{ text }}
  </p>
</template>

<script>
export default {
  props: [
    "type",
    "text"
  ]
}
</script>
