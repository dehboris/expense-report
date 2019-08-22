<template>
  <div class="group w-full flex flex-wrap border-b-2 py-2 md:px-4">
    <div class="w-full sm:w-9/12 font-semibold pr-1 sm:pr-0">
      <span class="font-bold sm:hidden text-gray-900">Name:</span>
      <span>{{ item.name }}</span>
    </div>
    <div class="w-full flex self-center sm:justify-between sm:pl-10 sm:w-2/12 sm:text-right">
      <span class="inline-block font-bold mr-auto sm:hidden">Amount:</span>
      <span>$</span>
      <span :class="['inline-block ml-5 tracking-wide', item.type.toString() === 'debit' ? 'text-red-700' : 'text-green-700']">
            {{ item.amount.formatted.replace(/\$*/g, '') }}
        </span>
    </div>
    <div class="sm:w-1/12 text-right self-center">
      <button class="text-xs text-red-700 cursor-pointer hidden group-hover:inline-block hover:underline" @click="removeItem">Delete</button>
    </div>
  </div>
</template>

<script>
  export default {
    name: "BucketExpenseItem",

    props: {
      item: {
        type: Object,
        required: true,
      },
    },

    methods: {
      /**
       * Delete an item from the server
       * @return void
       */
      removeItem() {
        axios.delete(route('api.expense-report.buckets.items.destroy', this.item.id))
          .then(() => {
            this.$emit('removeExpenseItem', this.item);
          })
          .catch(() => {
            this.$parent.$emit('flash', 'danger', 'We\'re experiencing problems deleting expense items at this time.')
          })
      }
    },
  }
</script>
