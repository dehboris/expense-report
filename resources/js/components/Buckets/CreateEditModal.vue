<template>
  <modal @closeModal="close">
    <template v-slot:header>{{ Object.keys(bucket).length > 0 ? 'Editing' : 'Create' }} Bucket</template>

    <template v-slot:body>
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
    </template>

    <template v-slot:footer>
      <button class="font-bold bg-yellow-600 text-gray-100 rounded px-2 transition-fast hover:bg-yellow-700 mr-auto" @click="close" :disabled="submitting">Cancel</button>
      <button class="font-bold bg-green-600 text-gray-100 rounded px-2 transition-fast hover:bg-green-700" @click="submit" :disabled="submitting">
        {{ Object.keys(bucket).length > 0 ? 'Update' : 'Create' }}
      </button>
    </template>
  </modal>
</template>

<script>
  import Modal from "../Shared/Modal";

  export default {
    name: "CreateEditModal",

    components: { Modal },

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

    created() {
      if (Object.keys(this.bucket).length > 0) {
        this.name = this.bucket.name;
        this.description = this.bucket.description;
      }
    },

    methods: {
      /**
       * Close modal and reset values
       * @return void
       */
      close() {
        if (!this.submitting) {
          this.name = null;
          this.description = null;
          this.errors = {};
          this.$emit('close');
        }
      },

      /**
       * Start the submission process - triggers create or update requests
       * @return void
       */
      submit() {
        this.submitting = true;

        Object.keys(this.bucket).length > 0 ? this.updateBucket() : this.createBucket();
      },

      /**
       * Creates a new bucket
       * @return void
       */
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
              this.submitting = false;
              this.$parent.$emit('flash', 'danger', 'We\'re experiencing trouble creating buckets at this time.')
            }

            this.close();
          })
      },

      /**
       * Updates a bucket
       * @return void
       */
      updateBucket() {
        axios.patch(route('api.expense-report.buckets.update', this.bucket.id).url(), {
          name: this.name,
          description: this.description,
        })
          .then(response => {
            this.submitting = false;
            this.$emit('updateBucket', response.data.data);
            this.$parent.$emit('flash', 'success', 'Bucket updated successfully.');
            this.close();
          })
          .catch(error => {
            if (error.response.status === 422) {
              this.errors = error.response.data.errors;
              this.submitting = false;
            } else {
              this.$parent.$emit('flash', 'danger', 'We\'re experiencing trouble updating buckets at this time.')
              this.submitting = false;
            }

            this.close();
          })
      },
    },
  }
</script>
