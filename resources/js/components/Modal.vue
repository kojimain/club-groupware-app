<template>
  <transition name="modal">
    <div class="modal">
      <div class="modal-background"></div>
      <div class="modal-content">
        <slot name="modal-content" />
      </div>
      <button
        class="modal-close is-large"
        aria-label="close"
        @click="$emit('close')"
      />
    </div>
  </transition>
</template>
