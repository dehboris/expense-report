<template>
  <transition
    enter-active-class="transition-slow"
    enter-to-class="opacity-100 mr-0"
    enter-class="opacity-0 -mr-6"
    leave-active-class="transition-slow"
    leave-class="opacity-100 mr-0"
    leave-to-class="opacity-0 -mr-6"
    mode="out-in"
  >
    <div
      v-if="showAlert"
      :class="[
        'fixed right-0 top-0 max-w-sm font-semibold rounded-lg shadow-md px-4 py-3 mt-24 w-64 md:w-auto',
        status === 'success' ? 'bg-green-200 text-green-800' : '',
        status === 'warning' ? 'bg-yellow-200 text-yellow-800' : '',
        status === 'info' ? 'bg-blue-200 text-blue-800' : '',
        status === 'danger' ? 'bg-red-200 text-red-800' : '',
      ]"
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
        type: '',
      }
    },

    created() {
      this.setClasses();
      setTimeout(() => {
        this.hide();
      }, 4000)
    },

    methods: {
      setClasses() {
        if (this.status === 'success') {
          this.type = 'green';
        } else if (this.status === 'danger') {
          this.type = 'red';
        } else if (this.status === 'warning') {
          this.type = 'yellow';
        } else {
          this.type = 'blue';
        }
      },

      hide() {
        this.$emit('hide');
        this.showAlert = false;
      }
    },
  }
</script>
