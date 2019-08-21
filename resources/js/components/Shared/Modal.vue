<template>
  <div>
    <transition
        enter-active-class="transition-fast"
        enter-class=" opacity-0 -mt-16"
        enter-to-class="opacity-100"
        leave-active-class="transition-fast"
        leave-class="opacity-100"
        leave-to-class="opacity-0 -mt-16"
        mode="out-in">
      <div class="fixed top-0 left-0 w-full h-full z-50" @click="$emit('closeModal')">
        <div class="relative w-auto max-w-lg bg-white rounded mx-auto mt-4 md:mt-16" @click.stop>
          <div class="relative">
            <div class="absolute right-0 text-xl cursor-pointer mr-3 -mt-1" @click="$emit('closeModal')">
              &times;
            </div>
          </div>
          <h3 class="border-b-2 border-gray-400 leading-none p-6"><slot name="header"></slot></h3>

          <div class="flex flex-wrap leading-tight font-semibold p-6 border-b-2 borderg-gray-400">
            <slot name="body"></slot>
          </div>

          <div class="flex p-6">
            <slot name="footer"></slot>
          </div>
        </div>
      </div>
    </transition>

    <transition
        enter-active-class="transition-fast"
        enter-class=" opacity-0"
        enter-to-class="opacity-25"
        leave-active-class="transition-fast"
        leave-class="opacity-25"
        leave-to-class="opacity-0"
        mode="out-in">
      <div class="fixed top-0 left-0 w-screen h-screen bg-black opacity-50 z-40" @click="$emit('closeModal')"></div>
    </transition>
  </div>
</template>

<script>
  export default {
    name: "Modal",
  }
</script>
