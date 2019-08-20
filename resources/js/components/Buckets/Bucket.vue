<template>
  <div v-if="!loading" class="max-w-5xl mx-auto sm:px-4">
    <div class="md:mb-10">
      <h1 class="text-3xl text-center -mb-4">{{ bucket.name }}</h1>
      <p class="text-xl font-semibold text-gray-600 text-center">{{ bucket.description }}</p>

      <div class="flex">
        <router-link class="text-red-800 mr-auto hover:underline" to="/">Back</router-link>
        <button class="font-bold bg-yellow-600 text-gray-100 rounded px-2 transition-fast hover:bg-yellow-700 mr-3" @click="modalIsOpen = true">Edit</button>
        <button class="font-bold bg-red-600 text-gray-100 rounded px-2 transition-fast hover:bg-red-700">Delete</button>
      </div>
    </div>

    <div class="flex flex-wrap justify-center p-4 sm:shadow-lg sm:p-10">
      <div role="form" class="w-full flex flex-wrap border-b-2 border-gray-400 pb-6 mb-3">
        <div class="w-full mb-3 md:w-5/12 md:px-3 md:mb-0">
          <label for="name" class="block font-semibold">Title:</label>
          <input type="text" id="name" class="input" placeholder="Jerseys" v-model="form.name">

            <p v-if="form.errors.name !== undefined" class="text-xs text-red-600 mt-1">{{ form.errors.name[0] }}</p>
        </div>

        <div class="w-full mb-6 md:w-2/12 md:px-3 md:mb-0 xl:w-3/12">
          <label for="amount" class="block font-semibold">Amount:</label>
          <input type="text" id="amount" class="input" placeholder="245.99" v-model="form.amount">

          <p v-if="form.errors.amount !== undefined" class="text-xs text-red-600 mt-1">{{ form.errors.amount[0] }}</p>
        </div>

        <div class="w-full flex flex-wrap self-center mb-6 md:w-2/12 md:px-3 md:mb-0">
          <label for="credit" class="w-full block">
            <input type="radio" name="type" id="credit" value="credit" v-model="form.type">
            Credit
          </label>

          <label for="debit" class="w-full block">
            <input type="radio" name="type" id="debit" value="debit" v-model="form.type">
            Debit
          </label>

          <p v-if="form.errors.type !== undefined" class="text-xs text-red-600 mt-1">{{ form.errors.type[0] }}</p>
        </div>

          <div class="w-full flex justify-end md:w-2/12 md:px-3 self-end">
            <button :class="['transition-normal bg-green-600 text-gray-100 font-semibold rounded py-1 px-3 hover:bg-green-700', { 'cursor-not-allowed': form.submitting }]" :disabled="form.submitting" @click="createExpenseItem">Create</button>
          </div>
      </div>

      <template v-if="bucket.items.data.length > 0">
        <div class="w-full flex justify-end border-b-2 border-gray-400 pb-3 mb-3 md:px-4">
          <span>Balance:</span>
          <span class="inline-block px-2">$</span>
          <span :class="['tracking-wide', { 'text-red-700' : calculated_balance < 0 }, { 'text-green-700' : calculated_balance > 0 }]">
            {{ calculated_balance.format('0,0.00').replace('-', '') }}
          </span>
        </div>

        <transition-group
            tag="div"
            class="w-full flex flex-wrap justify-center"
            enter-active-class="transition-fast opacity-100"
            enter-class="-mt-16"
            leave-active-class="transition-fast opacity-100"
            leave-to-class="opacity-0 -mt-16"
            mode="out-in">
          <bucket-expense-item
            v-for="item in bucket.items.data"
            :key="item.id"
            :item="item"
            @removeExpenseItem="removeExpenseItem"
          />
        </transition-group>
      </template>

      <template v-else>
        <div class="w-full flex flex-wrap items-center mt-2">
          <div class="w-full text-center">
            <p class="text-lg text-gray-700 font-bold mb-6">You do not have any items yet. Start off by creating one!</p>
          </div>

          <div class="w-full" v-pre>
            <svg class="block h-auto w-64 mx-auto" role="img" id="f1410098-b6ef-424e-beee-8c1519bc1d1f" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="915.68773" height="679.27607" viewBox="0 0 915.68773 679.27607"><defs><linearGradient id="b5076013-d6c0-4649-8f63-d536232108ef" x1="549.23403" y1="734.77229" x2="549.23403" y2="126.56914" gradientTransform="matrix(0.97485, 0.30762, -0.30291, 0.99, 144.20301, -171.28919)" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="gray" stop-opacity="0.25"/><stop offset="0.53514" stop-color="gray" stop-opacity="0.12"/><stop offset="1" stop-color="gray" stop-opacity="0.1"/></linearGradient><linearGradient id="be72c466-93ff-4e9c-a64c-30b94918ee69" x1="549.32281" y1="679.27607" x2="549.32281" y2="233.83602" gradientTransform="matrix(1, 0, 0, 1, 0, 0)" xlink:href="#b5076013-d6c0-4649-8f63-d536232108ef"/></defs><title>Credit card</title><rect x="184.85689" y="201.52958" width="728.622" height="445.00176" rx="27.5" transform="translate(-243.24579 71.69262) rotate(-17.2615)" fill="url(#b5076013-d6c0-4649-8f63-d536232108ef)"/><rect x="193.71997" y="205.56022" width="713.75592" height="429.25181" rx="27.5" transform="translate(-242.04064 71.94381) rotate(-17.2615)" fill="#fff"/><rect x="155.9523" y="267.86085" width="713.75592" height="61.55937" transform="translate(-207.67506 55.26252) rotate(-17.2615)" fill="#2a4365"/><rect x="303.66876" y="610.48755" width="181.35057" height="26.62027" transform="translate(-309.4966 34.74867) rotate(-17.2615)" fill="#bdbdbd"/><rect x="287.34157" y="547.84131" width="314.45191" height="26.62027" transform="translate(-288.64532 46.83008) rotate(-17.2615)" fill="#e0e0e0"/><rect x="182.9579" y="233.83602" width="732.72983" height="445.44005" rx="27.5" fill="url(#be72c466-93ff-4e9c-a64c-30b94918ee69)"/><rect x="191.27673" y="238.37789" width="713.75592" height="429.25181" rx="27.5" fill="#fff"/><rect x="361.01292" y="446.76044" width="20.79708" height="59.06372" fill="#e0e0e0"/><rect x="387.63319" y="446.76044" width="20.79708" height="59.06372" fill="#e0e0e0"/><rect x="414.25346" y="446.76044" width="20.79708" height="59.06372" fill="#e0e0e0"/><rect x="460.83892" y="446.76044" width="20.79708" height="59.06372" fill="#e0e0e0"/><rect x="487.45919" y="446.76044" width="20.79708" height="59.06372" fill="#e0e0e0"/><rect x="514.07946" y="446.76044" width="20.79708" height="59.06372" fill="#e0e0e0"/><rect x="560.66493" y="446.76044" width="20.79708" height="59.06372" fill="#e0e0e0"/><rect x="587.28519" y="446.76044" width="20.79708" height="59.06372" fill="#e0e0e0"/><rect x="613.90546" y="446.76044" width="20.79708" height="59.06372" fill="#e0e0e0"/><rect x="660.49093" y="446.76044" width="20.79708" height="59.06372" fill="#e0e0e0"/><rect x="687.1112" y="446.76044" width="20.79708" height="59.06372" fill="#e0e0e0"/><rect x="713.73147" y="446.76044" width="20.79708" height="59.06372" fill="#e0e0e0"/><rect x="236.68773" y="350.83602" width="124" height="68" fill="#2a4365"/><rect x="718.68773" y="573.83602" width="76" height="76" fill="#2a4365" opacity="0.1"/><rect x="756.68773" y="573.83602" width="76" height="76" fill="#2a4365" opacity="0.1"/></svg>
          </div>
        </div>
      </template>
    </div>

    <transition
        enter-active-class="transition-fast"
        enter-class=" opacity-0 -mt-16"
        enter-to-class="opacity-100"
        leave-active-class="transition-fast"
        leave-class="opacity-100"
        leave-to-class="opacity-0 -mt-16"
        mode="out-in">
      <create-edit-modal v-if="modalIsOpen" :bucket="bucket" @updateBucket="updateBucket" @close="modalIsOpen = false"/>
    </transition>

    <transition
        enter-active-class="transition-fast"
        enter-class=" opacity-0"
        enter-to-class="opacity-25"
        leave-active-class="transition-fast"
        leave-class="opacity-25"
        leave-to-class="opacity-0"
        mode="out-in">
      <div class="fixed top-0 left-0 w-screen h-screen bg-black opacity-50 z-40" v-if="modalIsOpen" @click="modalIsOpen = false"></div>
    </transition>
  </div>
</template>

<script>
  import CreateEditModal from "./CreateEditModal";
  import BucketExpenseItem from "./BucketExpenseItem";

  const numeral = require('numeral');

  export default {
    name: "Bucket",
    components: {BucketExpenseItem, CreateEditModal},
    data() {
      return {
        loading: true,
        modalIsOpen: false,
        bucket: {},
        calculated_balance: null,

        form: {
          submitting: false,
          errors: {},
          name: '',
          amount: '',
          type: 'debit',
        },
      }
    },

    beforeRouteUpdate (to, from, next) {
      this.bucket = {};
      this.fetchData(to.params.id);
      next();
    },

    created() {
      this.fetchData(this.$route.params.id);
    },

    methods: {
      fetchData(id) {
        this.loading = true;

        axios.all([this.fetchBucket(id), this.fetchBucketItems(id)])
          .then(axios.spread((bucket, items) => {
            this.bucket = {...bucket.data.data, items: items.data};
            this.calculated_balance = numeral(this.bucket.balance.amount / 100);

            this.loading = false;
          }))
          .catch(error => {
            console.log(error.data);
          })
      },

      fetchBucket(id) {
        return axios(route('api.expense-report.buckets.show', id).url());
      },

      fetchBucketItems(id) {
        return axios(route('api.expense-report.buckets.items.index', id).url());
      },

      updateBucket(bucket) {
        this.bucket.name = bucket.name;
        this.bucket.description = bucket.description;
      },

      createExpenseItem() {
        this.form.submitting = true;
        axios.post(route('api.expense-report.buckets.items.store', this.bucket.id), {
          name: this.form.name,
          amount: this.form.amount,
          type: this.form.type,
        })
          .then(response => {
            this.bucket.items.data.unshift(response.data.data);
            if (response.data.data.type === 'credit') {
              this.calculated_balance = this.calculated_balance.add(response.data.data.amount.amount / 100);
            } else {
              this.calculated_balance = this.calculated_balance.subtract(response.data.data.amount.amount / 100);
            }
            this.form.submitting = false;
            this.form.name = '';
            this.form.amount = '';
            this.form.type = 'debit';
          })
          .catch(error => {
            this.form.errors = error.response.data.errors;
            this.form.submitting = false;
          })
      },

      removeExpenseItem(item) {
        const index = this.bucket.items.data.findIndex(el => {
          return parseInt(el.id) === parseInt(item.id);
        })

        this.bucket.items.data.splice(index, 1);
        // console.log(this.current_balance, item.amount / 100);
        if (item.type === 'credit') {
          this.calculated_balance = this.calculated_balance.subtract(item.amount.amount / 100);
        } else {
          this.calculated_balance = this.calculated_balance.add(item.amount.amount / 100);
        }
      },
    },
  }
</script>
