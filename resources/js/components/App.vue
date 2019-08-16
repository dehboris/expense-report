<template>
  <div>
    <transition
      name="fade"
      mode="out-in"
    >
      <router-view
        @flash="flash"
      />
    </transition>

    <flash-message
      v-if="showFlash"
      :message="flashMessage"
      :status="flashType"
      @hide="hideMessage"
    />
  </div>
</template>

<script>
  import FlashMessage from "./Shared/FlashMessage";

  export default {
    name: "App",

    components: { FlashMessage },

    data() {
      return {
        showFlash: false,
        flashType: '',
        flashMessage: '',
        error: false,
      }
    },

    methods: {
      flash(type, message) {
        this.flashType = type;
        this.flashMessage = message;
        this.showFlash = true;
      },

      hideMessage() {
        this.showFlash = false;
        this.flashType = '';
        this.flashMessage = '';
      }
    },
  }
</script>

<style>
  .fade-enter-active, .fade-leave-active {
    transition: opacity .15s;
  }
  .fade-enter, .fade-leave-to {
    opacity: 0;
  }
</style>
