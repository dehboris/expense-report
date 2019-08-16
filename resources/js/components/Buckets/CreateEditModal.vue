<template>
  <div class="fixed top-0 left-0 w-full h-full z-50" @click="close">
    <div class="relative w-auto max-w-lg bg-white rounded mx-auto mt-4 md:mt-16" @click.stop>
      <div class="relative">
        <div class="absolute right-0 text-xl cursor-pointer mr-3 -mt-1" @click="close">
          &times;
        </div>
      </div>
      <h3 class="border-b-2 border-gray-400 leading-none p-6">{{ Object.keys(bucket).length > 0 ? 'Editing' : 'Create' }} Bucket</h3>

      <div class="flex flex-wrap leading-tight font-semibold p-6 border-b-2 borderg-gray-400">
        <div class="w-full mb-6">
          <label for="name" class="block mb-2">Bucket Name:</label>
          <input type="text" :class="['input', { 'border-red-500' : errors.name !== undefined } ]" id="name" placeholder="Soccer Team" v-model="name">

          <p v-if="errors.name !== undefined" v-text="errors.name[0]" class="text-red-600 font-normal text-xs mt-1"></p>
        </div>
        <div class="w-full">
          <label for="description" class="block mb-2">Bucket Description:</label>
          <input type="text" :class="['input', { 'border-red-500' : errors.description !== undefined } ]" id="description" placeholder="Soccer team 2019 season expenses" v-model="description">

          <p v-if="errors.description !== undefined" v-text="errors.description[0]" class="text-red-600 font-normal text-xs mt-1"></p>
        </div>
      </div>

      <div class="flex p-6">
        <button class="font-bold bg-yellow-600 text-gray-100 rounded px-2 transition-fast hover:bg-yellow-700 mr-auto" @click="close" :disabled="submitting">Cancel</button>
        <button class="font-bold bg-green-600 text-gray-100 rounded px-2 transition-fast hover:bg-green-700" @click="submit" :disabled="submitting">Create</button>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    name: "CreateEditModal",

    props: {
      bucket: {
        type: Object,
        required: false,
        default: () => ({}),
      },
    },

    data() {
      return {
        name: null,
        description: null,
        submitting: false,
        errors: {},
      }
    },

    methods: {
      close() {
        if (!this.submitting) {
          this.name = null;
          this.description = null;
          this.errors = {};
          this.$emit('close');
        }
      },

      submit() {
        this.submitting = true;

        Object.keys(this.bucket).length > 0 ? this.updateBucket() : this.createBucket();
      },

      createBucket() {
        axios.post(route('api.expense-report.buckets.store').url(), {
          name: this.name,
          description: this.description,
        })
          .then(response => {
            this.submitting = false;
            this.$emit('newBucket', response.data.data);
            this.$parent.$emit('flash', 'success', 'Bucket created successfully.');
            this.close();
          })
          .catch(error => {
            if (error.response.status === 422) {
              this.errors = error.response.data.errors;
              this.submitting = false;
            } else {
              this.$root.$emit('flash', 'danger', 'We\'re experiencing trouble creating buckets at this time.')
            }
          })
      },

      updateBucket() {},
    },
  }
</script>
