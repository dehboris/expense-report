<template>
  <router-link class="w-full flex flex-wrap border-b-2 py-2 md:w-5/6 md:px-4" :to="`buckets/${bucket.id}`">
    <p class="w-full sm:w-4/12 font-semibold text-teal-700 pr-1 sm:pr-0 hover:underline">
      <span class="font-bold sm:hidden text-gray-900">Name:</span>
      {{ bucket.name }}
    </p>
    <p class="w-full sm:w-6/12 pr-1 sm:pr-0">
      <span class="font-bold sm:hidden">Description:</span>
      {{ bucket.description }}
    </p>
    <div class="w-full sm:flex sm:self-center sm:justify-between sm:w-2/12 sm:text-right">
      <span class="font-bold sm:hidden">Balance:</span>
      <span class="inline-block pl-4">$</span>
      <span :class="['tracking-wide', { 'text-red-700': bucket.balance.amount < 0 }, { 'text-green-700': bucket.balance.amount > 0 }]">
          {{ bucket.balance.formatted.replace('$', '').replace('-', '') }}
      </span>
    </div>
  </router-link>
</template>

<script>
  export default {
    name: "BucketListItem",

    props: {
      bucket: {
        type: Object,
        required: true,
      }
    },
  }
</script>
