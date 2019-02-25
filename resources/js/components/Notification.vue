<template>
  <div
    class="notification"
    :class="[`is-${type}`]">
      {{ text }}
  </div>
</template>

<script>
export default {
  props: [
    "type",
    "text"
  ]
}
</script>
