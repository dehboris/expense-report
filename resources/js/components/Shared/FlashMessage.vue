<template>
  <transition
    name="fade"
    mode="out-in"
  >
    <div
      v-if="showAlert"
      :class="['fixed right-0 top-0 max-w-sm rounded shadow-md px-4 py-3 mt-24 w-64 md:w-auto', 'alert-' + status]"
      role="alert"
    >
      <div class="flex">
        <div class="py-1">
          <svg
            class="fill-current h-6 w-6 mr-4"
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 20 20"
          >
            <path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z" />
          </svg>
        </div>
        <div class="self-center">
          {{ message }}
        </div>
      </div>
    </div>
  </transition>
</template>

<script>
  export default {
    name: "FlashMessage",
    props: {
      status: {
        type: String,
        required: true,
      },
      message: {
        type: String,
        required: true,
      },
    },

    data() {
      return {
        showAlert: true,
      }
    },

    created() {
      setTimeout(() => {
        this.hide();
      }, 4000)
    },

    methods: {
      hide() {
        this.$emit('hide');
        this.showAlert = false;
      }
    },
  }
</script>

<style scoped>
    .fade-enter-active, .fade-leave-active {
        transition: opacity .6s;
    }
    .fade-enter, .fade-leave-to {
        opacity: 0;
    }
</style>
