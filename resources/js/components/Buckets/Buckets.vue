<template>
  <div class="max-w-5xl mx-auto sm:px-4">
    <template v-if="!loading">
      <h1 class="text-3xl text-center md:mb-10">Your Buckets</h1>

      <div class="flex flex-wrap justify-center p-4 sm:shadow-lg sm:p-10">

        <template v-if="buckets.data.length > 0">
          <div class="w-full mb-10 md:w-5/6">
            <button class="font-bold bg-teal-600 text-gray-100 rounded py-1 px-2 transition-fast hover:bg-teal-700" @click="modalIsOpen = true">New Bucket</button>
          </div>

          <div class="w-full hidden sm:flex font-bold border-b-2 border-gray-400 md:w-5/6 md:px-4">
            <p class="w-4/12">Name</p>
            <p class="w-6/12">Description</p>
            <p class="w-2/12 text-right">Balance</p>
          </div>

          <transition-group
            tag="div"
            class="w-full flex flex-wrap justify-center"
            enter-active-class="transition-fast opacity-100"
            enter-class="-mt-16"
            leave-active-class="transition-fast opacity-100"
            leave-to-class="opacity-0 -mt-16"
            mode="out-in">
            <bucket-list-item
              v-for="bucket in buckets.data"
              :key="bucket.id"
              :bucket="bucket"
            />
          </transition-group>
        </template>

        <template v-else>
          <div class="w-full flex flex-wrap items-center mt-2">
            <div class="w-full text-center mb-4">
              <p class="text-lg text-gray-700 font-bold leading-tight">You do not have any buckets yet. Start off by creating one!</p>
              <p class="text-sm text-gray-600 mb-6">Buckets are like accounts. A place where you can record transactions.</p>
                <button class="font-bold bg-teal-600 text-gray-100 rounded py-1 px-2 transition-fast hover:bg-teal-700" @click="modalIsOpen = true">Create New Bucket</button>
            </div>

            <div class="w-full" v-pre>
              <svg class="mx-auto w-64 h-auto" version="1.1" viewBox="0 0 1118 802.8" xml:space="preserve" xmlns="http://www.w3.org/2000/svg">
<title>Savings</title>
                <ellipse cx="559" cy="734.9" rx="559" ry="67.9" enable-background="new    " fill="#2A4365" opacity=".1"/>
                <ellipse cx="542.6" cy="664.5" rx="37.6" ry="39.9" fill="#FBD56F"/>
                <ellipse cx="542.6" cy="664.5" rx="37.6" ry="39.9" enable-background="new    " opacity=".1"/>
                <ellipse cx="549" cy="665.4" rx="37.6" ry="39" fill="#FBD56F"/>
                <path d="m564.3 700.7l-3.9-2.2s-1.8 7.6-1.2 13.1c0.1 1.1 0.9 2.1 2 2.3 9 2.2 51.8 11.7 81.3-1.7 0.9-0.4 1.5-1.2 1.6-2.2 0.4-3.3-0.9-10.2-1.4-11.6-1.2-2.7-78.4 2.3-78.4 2.3z" fill="#FBD56F"/>
                <path d="m564.3 700.7l-3.9-2.2s-1.8 7.6-1.2 13.1c0.1 1.1 0.9 2.1 2 2.3 9 2.2 51.8 11.7 81.3-1.7 0.9-0.4 1.5-1.2 1.6-2.2 0.4-3.3-0.9-10.2-1.4-11.6-1.2-2.7-78.4 2.3-78.4 2.3z" enable-background="new    " opacity=".1"/>
                <ellipse cx="601.5" cy="698.6" rx="41.1" ry="9.3" fill="#FBD56F"/>
                <path d="m580 687.1l-3.9-2.2s-1.8 7.6-1.2 13.1c0.1 1.1 0.9 2.1 2 2.3 9 2.2 51.8 11.7 81.3-1.7 0.9-0.4 1.5-1.2 1.6-2.2 0.4-3.3-0.9-10.2-1.4-11.6-1.2-2.8-78.4 2.3-78.4 2.3z" fill="#FBD56F"/>
                <path d="m580 687.1l-3.9-2.2s-1.8 7.6-1.2 13.1c0.1 1.1 0.9 2.1 2 2.3 9 2.2 51.8 11.7 81.3-1.7 0.9-0.4 1.5-1.2 1.6-2.2 0.4-3.3-0.9-10.2-1.4-11.6-1.2-2.8-78.4 2.3-78.4 2.3z" enable-background="new    " opacity=".1"/>
                <ellipse cx="617.2" cy="684.9" rx="41.1" ry="9.3" fill="#FBD56F"/>
                <path d="m593.8 669.1l-3.9-2.2s-1.8 7.6-1.2 13.1c0.1 1.1 0.9 2.1 2 2.3 9 2.2 51.8 11.7 81.3-1.7 0.9-0.4 1.5-1.2 1.6-2.2 0.4-3.3-0.9-10.2-1.4-11.6-1.1-2.8-78.4 2.3-78.4 2.3z" fill="#FBD56F"/>
                <path d="m593.8 669.1l-3.9-2.2s-1.8 7.6-1.2 13.1c0.1 1.1 0.9 2.1 2 2.3 9 2.2 51.8 11.7 81.3-1.7 0.9-0.4 1.5-1.2 1.6-2.2 0.4-3.3-0.9-10.2-1.4-11.6-1.1-2.8-78.4 2.3-78.4 2.3z" enable-background="new    " opacity=".1"/>
                <ellipse cx="631" cy="666.9" rx="41.1" ry="9.3" fill="#FBD56F"/>
                <path d="m578.5 650.4l-3.9-2.2s-1.8 7.6-1.2 13.1c0.1 1.1 0.9 2.1 2 2.3 9 2.2 51.8 11.7 81.3-1.7 0.9-0.4 1.5-1.2 1.6-2.2 0.4-3.3-0.9-10.2-1.4-11.6-1.2-2.8-78.4 2.3-78.4 2.3z" fill="#FBD56F"/>
                <path d="m578.5 650.4l-3.9-2.2s-1.8 7.6-1.2 13.1c0.1 1.1 0.9 2.1 2 2.3 9 2.2 51.8 11.7 81.3-1.7 0.9-0.4 1.5-1.2 1.6-2.2 0.4-3.3-0.9-10.2-1.4-11.6-1.2-2.8-78.4 2.3-78.4 2.3z" enable-background="new    " opacity=".1"/>
                <ellipse cx="615.7" cy="648.2" rx="41.1" ry="9.3" fill="#FBD56F"/>
                <path d="m613.1 635.4l-3.9-2.2s-1.8 7.6-1.2 13.1c0.1 1.1 0.9 2.1 2 2.3 9 2.2 51.8 11.7 81.3-1.7 0.9-0.4 1.5-1.2 1.6-2.2 0.4-3.3-0.9-10.2-1.4-11.6-1.2-2.8-78.4 2.3-78.4 2.3z" fill="#FBD56F"/>
                <path d="m613.1 635.4l-3.9-2.2s-1.8 7.6-1.2 13.1c0.1 1.1 0.9 2.1 2 2.3 9 2.2 51.8 11.7 81.3-1.7 0.9-0.4 1.5-1.2 1.6-2.2 0.4-3.3-0.9-10.2-1.4-11.6-1.2-2.8-78.4 2.3-78.4 2.3z" enable-background="new    " opacity=".1"/>
                <ellipse cx="650.3" cy="633.2" rx="41.1" ry="9.3" fill="#FBD56F"/>
                <path d="m589.7 625.3l-3.9-2.2s-1.8 7.6-1.2 13.1c0.1 1.1 0.9 2.1 2 2.3 9 2.2 51.8 11.7 81.3-1.7 0.9-0.4 1.5-1.2 1.6-2.2 0.4-3.3-0.9-10.2-1.4-11.6-1.2-2.8-78.4 2.3-78.4 2.3z" fill="#FBD56F"/>
                <path d="m589.7 625.3l-3.9-2.2s-1.8 7.6-1.2 13.1c0.1 1.1 0.9 2.1 2 2.3 9 2.2 51.8 11.7 81.3-1.7 0.9-0.4 1.5-1.2 1.6-2.2 0.4-3.3-0.9-10.2-1.4-11.6-1.2-2.8-78.4 2.3-78.4 2.3z" enable-background="new    " opacity=".1"/>
                <ellipse cx="626.9" cy="623.1" rx="41.1" ry="9.3" fill="#FBD56F"/>
                <path d="m605.3 605.8l-3.9-2.2s-1.8 7.6-1.2 13.1c0.1 1.1 0.9 2.1 2 2.3 9 2.2 51.8 11.7 81.3-1.7 0.9-0.4 1.5-1.2 1.6-2.2 0.4-3.3-0.9-10.2-1.4-11.6-1.2-2.7-78.4 2.3-78.4 2.3z" fill="#FBD56F"/>
                <path d="m605.3 605.8l-3.9-2.2s-1.8 7.6-1.2 13.1c0.1 1.1 0.9 2.1 2 2.3 9 2.2 51.8 11.7 81.3-1.7 0.9-0.4 1.5-1.2 1.6-2.2 0.4-3.3-0.9-10.2-1.4-11.6-1.2-2.7-78.4 2.3-78.4 2.3z" enable-background="new    " opacity=".1"/>
                <ellipse cx="642.5" cy="603.6" rx="41.1" ry="9.3" fill="#FBD56F"/>
                <path d="m613 582.7l-3.9-2.2s-1.8 7.6-1.2 13.1c0.1 1.1 0.9 2.1 2 2.3 9 2.2 51.8 11.7 81.3-1.7 0.9-0.4 1.5-1.2 1.6-2.2 0.4-3.3-0.9-10.2-1.4-11.6-1.2-2.8-78.4 2.3-78.4 2.3z" fill="#FBD56F"/>
                <path d="m613 582.7l-3.9-2.2s-1.8 7.6-1.2 13.1c0.1 1.1 0.9 2.1 2 2.3 9 2.2 51.8 11.7 81.3-1.7 0.9-0.4 1.5-1.2 1.6-2.2 0.4-3.3-0.9-10.2-1.4-11.6-1.2-2.8-78.4 2.3-78.4 2.3z" enable-background="new    " opacity=".1"/>
                <ellipse cx="650.2" cy="580.5" rx="41.1" ry="9.3" fill="#FBD56F"/>
                <path d="m682.4 706.1l-3.9-2.2s-1.8 7.6-1.2 13.1c0.1 1.1 0.9 2.1 2 2.3 9 2.2 51.8 11.7 81.3-1.7 0.9-0.4 1.5-1.2 1.6-2.2 0.4-3.3-0.9-10.2-1.4-11.6-1.2-2.8-78.4 2.3-78.4 2.3z" fill="#FBD56F"/>
                <path d="m682.4 706.1l-3.9-2.2s-1.8 7.6-1.2 13.1c0.1 1.1 0.9 2.1 2 2.3 9 2.2 51.8 11.7 81.3-1.7 0.9-0.4 1.5-1.2 1.6-2.2 0.4-3.3-0.9-10.2-1.4-11.6-1.2-2.8-78.4 2.3-78.4 2.3z" enable-background="new    " opacity=".1"/>
                <ellipse cx="719.6" cy="703.9" rx="41.1" ry="9.3" fill="#FBD56F"/>
                <path d="m696.3 688.1l-3.9-2.2s-1.8 7.6-1.2 13.1c0.1 1.1 0.9 2.1 2 2.3 9 2.2 51.8 11.7 81.3-1.7 0.9-0.4 1.5-1.2 1.6-2.2 0.4-3.3-0.9-10.2-1.4-11.6-1.2-2.7-78.4 2.3-78.4 2.3z" fill="#FBD56F"/>
                <path d="m696.3 688.1l-3.9-2.2s-1.8 7.6-1.2 13.1c0.1 1.1 0.9 2.1 2 2.3 9 2.2 51.8 11.7 81.3-1.7 0.9-0.4 1.5-1.2 1.6-2.2 0.4-3.3-0.9-10.2-1.4-11.6-1.2-2.7-78.4 2.3-78.4 2.3z" enable-background="new    " opacity=".1"/>
                <ellipse cx="733.5" cy="686" rx="41.1" ry="9.3" fill="#FBD56F"/>
                <path d="m680.9 669.4l-3.9-2.2s-1.8 7.6-1.2 13.1c0.1 1.1 0.9 2.1 2 2.3 9 2.2 51.8 11.7 81.3-1.7 0.9-0.4 1.5-1.2 1.6-2.2 0.4-3.3-0.9-10.2-1.4-11.6-1.2-2.7-78.4 2.3-78.4 2.3z" fill="#FBD56F"/>
                <path d="m680.9 669.4l-3.9-2.2s-1.8 7.6-1.2 13.1c0.1 1.1 0.9 2.1 2 2.3 9 2.2 51.8 11.7 81.3-1.7 0.9-0.4 1.5-1.2 1.6-2.2 0.4-3.3-0.9-10.2-1.4-11.6-1.2-2.7-78.4 2.3-78.4 2.3z" enable-background="new    " opacity=".1"/>
                <ellipse cx="718.1" cy="667.3" rx="41.1" ry="9.3" fill="#FBD56F"/>
                <path d="m715.5 654.4l-3.9-2.2s-1.8 7.6-1.2 13.1c0.1 1.1 0.9 2.1 2 2.3 9 2.2 51.8 11.7 81.3-1.7 0.9-0.4 1.5-1.2 1.6-2.2 0.4-3.3-0.9-10.2-1.4-11.6-1.2-2.7-78.4 2.3-78.4 2.3z" fill="#FBD56F"/>
                <path d="m715.5 654.4l-3.9-2.2s-1.8 7.6-1.2 13.1c0.1 1.1 0.9 2.1 2 2.3 9 2.2 51.8 11.7 81.3-1.7 0.9-0.4 1.5-1.2 1.6-2.2 0.4-3.3-0.9-10.2-1.4-11.6-1.2-2.7-78.4 2.3-78.4 2.3z" enable-background="new    " opacity=".1"/>
                <ellipse cx="752.7" cy="652.2" rx="41.1" ry="9.3" fill="#FBD56F"/>
                <path d="m692.1 644.3l-3.9-2.2s-1.8 7.6-1.2 13.1c0.1 1.1 0.9 2.1 2 2.3 9 2.2 51.8 11.7 81.3-1.7 0.9-0.4 1.5-1.2 1.6-2.2 0.4-3.3-0.9-10.2-1.4-11.6-1.2-2.7-78.4 2.3-78.4 2.3z" fill="#FBD56F"/>
                <path d="m692.1 644.3l-3.9-2.2s-1.8 7.6-1.2 13.1c0.1 1.1 0.9 2.1 2 2.3 9 2.2 51.8 11.7 81.3-1.7 0.9-0.4 1.5-1.2 1.6-2.2 0.4-3.3-0.9-10.2-1.4-11.6-1.2-2.7-78.4 2.3-78.4 2.3z" enable-background="new    " opacity=".1"/>
                <ellipse cx="729.3" cy="642.2" rx="41.1" ry="9.3" fill="#FBD56F"/>
                <path d="m707.7 624.9l-3.9-2.2s-1.8 7.6-1.2 13.1c0.1 1.1 0.9 2.1 2 2.3 9 2.2 51.8 11.7 81.3-1.7 0.9-0.4 1.5-1.2 1.6-2.2 0.4-3.3-0.9-10.2-1.4-11.6-1.2-2.8-78.4 2.3-78.4 2.3z" fill="#FBD56F"/>
                <path d="m707.7 624.9l-3.9-2.2s-1.8 7.6-1.2 13.1c0.1 1.1 0.9 2.1 2 2.3 9 2.2 51.8 11.7 81.3-1.7 0.9-0.4 1.5-1.2 1.6-2.2 0.4-3.3-0.9-10.2-1.4-11.6-1.2-2.8-78.4 2.3-78.4 2.3z" enable-background="new    " opacity=".1"/>
                <ellipse cx="744.9" cy="622.7" rx="41.1" ry="9.3" fill="#FBD56F"/>
                <path d="m715.4 601.7l-3.9-2.2s-1.8 7.6-1.2 13.1c0.1 1.1 0.9 2.1 2 2.3 9 2.2 51.8 11.7 81.3-1.7 0.9-0.4 1.5-1.2 1.6-2.2 0.4-3.3-0.9-10.2-1.4-11.6-1.2-2.7-78.4 2.3-78.4 2.3z" fill="#FBD56F"/>
                <path d="m715.4 601.7l-3.9-2.2s-1.8 7.6-1.2 13.1c0.1 1.1 0.9 2.1 2 2.3 9 2.2 51.8 11.7 81.3-1.7 0.9-0.4 1.5-1.2 1.6-2.2 0.4-3.3-0.9-10.2-1.4-11.6-1.2-2.7-78.4 2.3-78.4 2.3z" enable-background="new    " opacity=".1"/>
                <ellipse cx="752.6" cy="599.6" rx="41.1" ry="9.3" fill="#FBD56F"/>
                <linearGradient id="a" x1="882.02" x2="882.02" y1="-28.637" y2="475.4" gradientTransform="matrix(1 0 0 -1 -41 753.41)" gradientUnits="userSpaceOnUse">
                            <stop stop-color="#808080" stop-opacity=".25" offset="0"/>
                  <stop stop-color="#808080" stop-opacity=".12" offset=".5351"/>
                  <stop stop-color="#808080" stop-opacity=".1" offset="1"/>
                        </linearGradient>
                <path d="m963.2 760.6c-5.7-0.2-5.9-2.4-13.3-6.3-4.2-2.2-10.5-8.4-15.2-13.5-0.4-0.4-0.7-0.8-1.1-1.2h1.9s-1.8-16.1-0.2-20 0.4-26.6 0.4-26.6 1-17.3-0.8-21.4 0.6-29.8 0.6-29.8 1.6-15.3 2-46.6-18-32.3-18-32.3-2.5-0.2-6.2-0.5c-0.4 0-0.7-0.1-1.1-0.1 2.4-5 3.8-8.8 3.8-8.8s-3.1-29.2-3.9-34.3c-0.8-5-5.7-25.8-5.7-25.8s-3.5-8.9-5.5-15.1-8.2-13.5-8.2-13.5-11-21.8-14.1-25c-1.4-1.5-3.4-3.4-5.1-5-0.3-0.3-0.6-0.6-0.9-0.8 0.5-2.3 0.7-4.6 0.7-6.9 0 0-11.4-11.3-12.3-14.1s-11.6-13.3-11.6-13.3-6.1-11.3-13.1-11.5c-3.3-0.2-6.6-0.1-9.8 0.3 1.4-5.3 3.1-10.8 4.6-15.6 0.2-0.5 0.3-1 0.5-1.6 5.6-3.8 9.9-9 12.6-15.2 0.1-0.3 0.3-0.7 0.4-1h0.2c0.3 0 0.6 0 0.9-0.1 2.3-0.4 4.2-3 3.2-5 0.1 0.2 0.4 0.4 0.7 0.4 0.8 0 1.7-1.1 1.9-2.1 0-0.2 0-0.3 0.1-0.5 0-0.2 0.1-0.4 0.1-0.6s0-0.4 0.1-0.6v-0.6-0.6-0.7-0.5c0-0.3 0-0.5-0.1-0.8v-0.3c-0.1-1.1-0.3-2.2-0.7-3.3-1.1-3.7-3.5-7.5-2.6-11.3v-0.1c0.8-3 3.3-5.1 4.9-7.7 0.1-0.3 0.3-0.5 0.4-0.8l0.1-0.1 0.3-0.6c0.1-0.1 0.1-0.3 0.2-0.4 0.1-0.2 0.1-0.4 0.2-0.5 0.1-0.2 0.1-0.3 0.2-0.5 0-0.2 0.1-0.3 0.1-0.5s0.1-0.4 0.1-0.6c0-0.1 0-0.3 0.1-0.4 0-0.2 0.1-0.4 0.1-0.7v-0.4-0.7-0.3-0.8-0.2c0-0.3-0.1-0.6-0.1-0.9v-0.1c-0.3-2.5-1.4-4.9-2.9-7-3.6-4.3-9.1-6.7-14.7-6.4-1.5 0.2-3.1 0.2-4.6 0.1-2.6-0.4-4.7-2-6.8-3.6l-17.1-13.2c-1.9-1.7-4.1-3-6.5-3.8-2.4-0.7-5.3-0.5-7.1 1.3-3.2 3.2-1.2 8.6-2.5 12.9-1.1 3.7-4.7 6.2-8.4 7.5s-7.7 1.5-11.5 2.4c-1.1 0.2-2.2 0.7-3.1 1.4-1 1.2-1.5 2.7-1.3 4.3 0 3.8 0.9 7.5 2.7 10.9 0.7 1.4 1.6 2.8 2.4 4.2 0.1 0.1 0.1 0.2 0.2 0.3 0.1 0.2 0.2 0.3 0.3 0.5 0.1 0.3 0.3 0.5 0.4 0.8 0.1 0.1 0.1 0.2 0.1 0.3 0.1 0.2 0.2 0.4 0.2 0.6 0 0.1 0.1 0.2 0.1 0.4 0.1 0.2 0.1 0.4 0.2 0.7 0.4 1.3 0.4 2.7 0.1 4-0.6 2.2-2.3 3.8-3.8 5.5-1.2 1.3-2.1 2.9-2.5 4.7-0.1 0.4-0.1 0.8 0 1.2v0.2c0 0.1 0 0.2 0.1 0.3 0 0.1 0 0.1 0.1 0.2 0 0.1 0.1 0.1 0.1 0.2l0.3 0.3 0.1 0.1c0.1 0.1 0.2 0.1 0.3 0.2 0.1 0 0.1 0.1 0.2 0.1 0.1 0.1 0.3 0.1 0.4 0.1h0.1 0.7 0.2c0.2 0 0.4 0 0.6-0.1h0.2c0.3-0.1 0.6-0.1 1-0.2 1.1-0.3 2.3-0.8 3.3-1.3v0.4 0.6c0.1 4 0.8 7.9 2.2 11.6 2.2 5.8 5.9 10.8 10.7 14.7-0.1 0.3-0.1 0.7-0.2 1-1 4.8-3 9.7-4.3 9.3-1.2-0.3-2.5-0.4-3.8-0.4h-1.1c-1.2-0.1-2.3-0.1-3.5 0-0.5 0-1 0-1.5-0.2-3.3-1-6.8-1.2-10.2-0.6-7.1 1.4-17.8 4.1-20.8 7.3-4.5 4.8-11 9.5-18.4 29.6 0 0-3.7 12.3-6.5 13.9 0.6-0.3 1.3-0.6 1.9-0.9-0.4 0.7-0.9 1.2-1.5 1.7 1-0.5 2.1-1 3.2-1.3-2.2 13.1 1.1 50.7 1.1 50.7s-2.7 6.5 0.8 10.3c2.1 2.3 3.2 5.8 3.8 8.3-0.2 0.3-0.3 0.5-0.5 0.8-1.8 2.9-4.3 6.6-5.9 8.6-2.9 3.6-2 15.1-2 15.1s-0.6 5.4-2.7 7.5-1.6 9.5-1.6 9.5l-5.3 19.6s-4.9 4.4-4.9 6.5-3.9 7.7-3.9 7.7-5.9 9.7 0 8.3c2.2-0.6 4.2-1.7 6-3v0.1 1.1c-0.2 10.5 1 25.4 8.8 25.4 12.1 0 43.1 14.3 43.1 14.3 6.3 4.8 14.9 3.2 14.9 3.2s-15.5 15-15.1 21.3-8.6 16.5-8.6 16.5l-27.8 54.2c0.2 3.8 0.8 7.5 2 11.1-0.1 0.1-0.3 0.2-0.4 0.3-10.7 9.8-11.6 29.1-11.6 29.1l-2.5 9.9 37.2 16.3s48.2 1 56.6-1.2 6.5-11.5-4.5-13.3-13.7-6.7-17.4-8.9c-2.5-1.5-11.3-11.2-16.8-17.3-0.1-0.1-0.2-0.2-0.2-0.3l1.3-7c2.5-1.2 6.1-13.3 6.1-13.3s0-4.8 2.5-6.3 7.6-15.9 7.6-15.9 11-18.4 10.4-20.8 8-14.7 8-14.7 14.5-14.1 13.9-16.6 11.6-15.4 11.6-15.4c4.4-3.4 8.1-7.6 10.9-12.5 1.1-0.2 2.3-0.4 3.5-0.6 16-2.6 42.7-7.4 45.7-8.7 4.1-1.8 3.3 6.3 1.6 13.1s-2.9 39.7-1 44 1 11.1 1 11.1l-2.5 36.9 1.6 7.9s-5.5 4.4-3.3 7.1 0.2 13.9 0.2 13.9c0.2-0.1 0.4-0.1 0.7-0.2-0.2 0.4-0.4 0.9-0.6 1.4-3.2 9-1.4 23.8-1.4 23.8v11.7s56.6 1 69.1 1 29.6-6 30.7-10.9-14.1-8.9-19.8-9.1zm-161-209.9l-3.7 0.3c1.2-0.2 2.4-0.3 3.7-0.3zm22.6-154.8c0.5-2.3 1.1-4.8 1.8-7.4l-1.8 7.4zm7 160.5c-3.5 1.4-7.5 1.4-11 0 0 0 0.2-14.1 1.8-20s3.9-16.5 3.9-16.5 1.8-14.7 3.7-21.4 9-43.8 12.7-46.2 5.7 1.8 5.7 1.8 0.5 0 1.5-0.1l0.6 1.2c4.4 8.8 17.2 26.9 17.2 26.9 3.8 2.3 7 5.5 9.4 9.3 3.5 5.8 4.5 19.6 4.5 19.6s7.8 30.5 11.4 34.7c1.8 2.1 1 3.4-0.3 4.1-2.6 1.4-4.8 3.5-6.4 6-0.5 0.8-1.1 1.7-1.6 2.7-1.4-0.3-2.7-0.7-3.7-1-10.2-3.4-43.9-3.6-49.4-1.1z" fill="url(#a)"/>
                <path d="m882.1 768v11.6s55.4 1 67.6 1 29-6 30-10.8-14-8.8-19.6-9-5.8-2.4-13-6.2c-4.1-2.1-10.2-8.4-14.8-13.4-3.5-3.9-6.2-7-6.2-7s-29.8-0.6-38.4 4.2c-2 1.1-3.3 3.3-4.3 6-3 8.9-1.3 23.6-1.3 23.6z" fill="#434175"/>
                <path d="m883.5 744.4c6.2-2.2 42.8-3 48.8-3.1-3.5-3.9-6.2-7-6.2-7s-29.8-0.6-38.4 4.2c-1.9 1-3.3 3.2-4.2 5.9z" enable-background="new    " opacity=".1"/>
                <path d="m722.8 559.4s1.2 0.7 3.2 2c0.4 0.2 0.8 0.5 1.2 0.7 1.3 0.8 2.9 1.7 4.7 2.8 25.1 15.1 93.7 56.2 97.4 55.9 1-0.1 3.9-0.5 8-1.2 1.1-0.2 2.2-0.4 3.5-0.6 15.7-2.6 41.8-7.3 44.7-8.6 4-1.8 3.2 6.2 1.6 13s-2.8 39.4-1 43.6 1 11 1 11l-2.4 36.6 1.6 7.8s-5.4 4.4-3.2 7 0.2 13.8 0.2 13.8c6.4-2.4 49.8-3.2 49.8-3.2s-1.8-16-0.2-19.8 0.4-26.4 0.4-26.4 1-17.2-0.8-21.2 0.6-29.6 0.6-29.6 1.6-15.2 2-46.2-17.6-32-17.6-32-2.4-0.2-6-0.5c-7.1-0.7-19-2-26.9-3.7-1.6-0.3-3.2-0.8-4.8-1.3-9.8-3.3-42.8-3.5-48.2-1.1-3.5 1.4-7.3 1.4-10.8 0l-4.2-6.8-40.1 3.4-4.3 0.4-39.5 3.4-2.7 0.2-7.2 0.6z" fill="#565387"/>
                <path d="m883.5 590.1c11.7 5.7 22.8-14.5 28-25.8-7.1-0.7-19-2-26.9-3.7-5.3 8.8-12.2 24.1-1.1 29.5z" enable-background="new    " opacity=".1"/>
                <path d="m848.6 454.1c0.2 1.4 0.7 2.7 1.4 3.9 4.3 8.7 16.8 26.7 16.8 26.7 3.7 2.3 6.9 5.5 9.2 9.2 3.4 5.8 4.4 19.4 4.4 19.4s7.6 30.2 11.2 34.4c1.8 2.1 1 3.4-0.2 4.1-2.6 1.4-4.7 3.4-6.3 5.9-5.2 8.4-13.6 25.2-1.8 30.9 16 7.8 31-33.1 31-33.1s-3-29-3.8-34-5.6-25.6-5.6-25.6-3.4-8.8-5.4-15-8-13.4-8-13.4-10.8-21.6-13.8-24.8c-1.4-1.5-3.3-3.4-5-4.9-2-1.8-3.6-3.3-3.6-3.3s-20.7 14.8-20.5 19.6z" fill="#EE8E9E"/>
                <path d="m713 765.6l36.4 16.2s47.2 1 55.4-1.2 6.4-11.4-4.4-13.2-13.4-6.6-17-8.8c-2.4-1.5-11.1-11.1-16.4-17.2-2.6-2.9-4.4-5-4.4-5s-7-18.6-26.4-14.4c-3.5 0.8-6.8 2.5-9.4 5-10.5 9.7-11.4 28.8-11.4 28.8l-2.4 9.8z" fill="#434175"/>
                <path d="m727.2 562.1c1.3 0.8 2.9 1.7 4.7 2.8 25.1 15.1 93.7 56.2 97.4 55.9 1-0.1 3.9-0.5 8-1.2 1.1-0.2 2.2-0.4 3.5-0.6 0-0.1 0.1-0.2 0.1-0.2 2-3.5 3.6-7.3 4.6-11.2 4.2-16-16.6-28.2-16.6-28.2l-4.4-3.4c-5-8.4-41-16.4-41-16.4l-4.6-3.1-2.5-1.7-0.7-0.4-5.6-3.8-28.2 2-8.4 5.4-0.9 0.6-3.1 2-2.3 1.5z" enable-background="new    " opacity=".1"/>
                <path d="m726.7 727c7.7 26.5 39.6 17.8 39.6 17.8l0.6-3.4c-2.6-2.9-4.4-5-4.4-5s-7-18.6-26.4-14.4c-3.5 0.8-6.7 2.5-9.4 5z" enable-background="new    " opacity=".1"/>
                <path d="m718.4 606.8c11.8 0 42.2 14.2 42.2 14.2 6.2 4.8 14.6 3.2 14.6 3.2s-14.8 15-14.4 21.2-8.4 16.4-8.4 16.4l-27.2 53.8c2 38.2 41.2 27.6 41.2 27.6l1.6-9c2.4-1.2 6-13.2 6-13.2s0-4.8 2.4-6.2 7.4-15.8 7.4-15.8 10.8-18.2 10.2-20.6 7.8-14.6 7.8-14.6 14.2-14 13.6-16.5 11.4-15.3 11.4-15.3c4.3-3.4 8-7.6 10.6-12.4 2-3.5 3.6-7.3 4.6-11.2 3.4-12.9-9.4-23.3-14.6-26.9-1.2-0.9-2-1.3-2-1.3l-4.4-3.4c-2.3-3.8-11-7.6-19.8-10.5-6.3-2.1-12.7-3.8-16.8-4.8-2.7-0.7-4.4-1-4.4-1l-4.6-3.1-1.6-1.1-1.5-1-5.6-3.8-12.5 0.9-15.6 1.1-8.4 5.4-4 2.6-15.6 10s-0.4 3.8-0.5 9v1.2c-0.5 10.4 0.7 25.1 8.3 25.1z" fill="#565387"/>
                <path d="m778.6 382.9l4.2 15s7.4 25.8 8.2 27.6 20.2 20 21 20.4 11.4 6.4 11.4 6.4 0.8-33 0-42.6c-0.1-2.1 0.1-4.2 0.5-6.3 1.3-7.5 4.5-18.6 7.2-27 2.2-7.1 4.1-12.5 4.1-12.5s-46.8-2-45.2 2.6c0.6 1.7 0.4 4.6-0.2 7.6-1 4.8-3 9.6-4.2 9.2-1.2-0.3-2.5-0.4-3.7-0.4-1.8-0.1-3.3 0-3.3 0z" fill="#EE8E9E"/>
                <path d="m789.8 374c11.7 9.8 28.5 10.7 41.3 2.3 2.2-7.1 4.1-12.5 4.1-12.5s-46.8-2-45.2 2.6c0.6 1.8 0.4 4.7-0.2 7.6z" enable-background="new    " opacity=".1"/>
                <path d="m846.6 346.3c0 3.7-0.6 7.3-1.7 10.8-0.3 0.9-0.6 1.8-1 2.6-7.4 17.6-27.7 25.8-45.3 18.4-8.8-3.7-15.6-10.8-18.9-19.8-1.4-3.7-2.1-7.6-2.2-11.5v-0.6c0-19.1 15.5-34.6 34.6-34.6s34.5 15.6 34.5 34.7z" fill="#EE8E9E"/>
                <path d="m778.6 382.9l4.2 15s7.4 25.8 8.2 27.6 20.2 20 21 20.4 11.4 6.4 11.4 6.4 0.8-33 0-42.6c-0.1-2.1 0.1-4.2 0.5-6.3l-2.7 11.1 0.2 22.2 1.6 1.2-3.6 5.4v-4s-12.8-12.4-14.8-17.6-9.2-14.6-9.2-14.6-8.2-13.8-8.4-16.2c-0.2-1.9-3.6-6.2-5.1-8-1.8-0.1-3.3 0-3.3 0z" enable-background="new    " opacity=".1"/>
                <path d="m848.6 454.1c0.2 1.4 0.7 2.7 1.4 3.9 4.4-0.4 19.3-3.2 22.5-20.2-2-1.8-3.6-3.3-3.6-3.3s-20.5 14.8-20.3 19.6z" enable-background="new    " opacity=".1"/>
                <path d="m709.8 581.7c4-2.9 7.9-6.8 10.2-7.8 3.4-1.6 8.6-6.8 8.6-6.8s1.3-0.9 3.3-2.1c3.7-2.2 9.8-5.3 14.5-5.7 4.2-0.3 18-1.2 29-1.9 7.9-0.5 14.2-0.9 14.2-0.9s13-4.6 18.6-1.6c4 2 8.2 3.6 12.6 4.6v-1.2l-4.2-6.8-44.4 3.8-5.6-3.8-28.2 2-8.4 5.4-7.2 0.6s1.2 0.7 3.2 2l-15.6 10c0-0.1-0.5 4.4-0.6 10.2z" enable-background="new    " opacity=".1"/>
                <path d="m704 583.4c2.1-0.6 4.1-1.6 5.9-3 4-2.9 7.9-6.7 10.1-7.8 3.4-1.6 8.6-6.8 8.6-6.8s10.6-7.2 17.8-7.8c2-0.2 6.1-0.4 11-0.8 5-0.3 11-0.7 16.3-1 3.1-0.2 6-0.4 8.5-0.5 4.4-0.3 7.4-0.5 7.4-0.5s13-4.6 18.6-1.6c4 2 8.2 3.6 12.6 4.6 0 0 0.2-14 1.8-19.8s3.8-16.4 3.8-16.4 1.8-14.6 3.6-21.2 8.8-43.4 12.4-45.8 5.6 1.8 5.6 1.8 24-0.4 24.4-26.8c0 0-11.2-11.2-12-14s-11.4-13.1-11.4-13.1-6-11.2-12.8-11.4c-3.2-0.2-6.4-0.1-9.6 0.3l-5.8 23.5 0.2 22.2 1.6 1.2-3.6 5.4v-4s-12.8-12.4-14.8-17.6-9.2-14.6-9.2-14.6-8.2-13.8-8.4-16.2-5.8-8.8-5.8-8.8c-1.1-0.1-2.3-0.1-3.4 0-0.5 0-1 0-1.5-0.2-3.2-1-6.7-1.2-10-0.6-6.9 1.4-17.4 4.1-20.3 7.2-4.4 4.8-10.8 9.4-18 29.4l38.8 14-3.4 6.3-30.9 58.7s-1 1.7-2.4 3.8c-1.8 2.8-4.2 6.5-5.8 8.5-2.8 3.6-2 15-2 15s-0.6 5.4-2.6 7.4-1.6 9.4-1.6 9.4l-5.2 19.4s-4.8 4.4-4.8 6.4-3.8 7.6-3.8 7.6-5.7 9.6 0.1 8.2z" fill="#434175"/>
                <path d="m908.7 597.8s-12.6 4.2-16 10.2 16-10.2 16-10.2z" enable-background="new    " opacity=".1"/>
                <path d="m902.3 584.6c-0.4 0.6-17.3 17.5-16.2 21.6s16.2-21.6 16.2-21.6z" enable-background="new    " opacity=".1"/>
                <path d="m809.8 596.6s-18.8 8.9-20.4 12.7 20.4-12.7 20.4-12.7z" enable-background="new    " opacity=".1"/>
                <path d="m808.6 608s-17 7.2-19.3 9 19.3-9 19.3-9z" enable-background="new    " opacity=".1"/>
                <path d="m800.8 623.4s-7.5 5.6-11.7 1.2 11.7-1.2 11.7-1.2z" enable-background="new    " opacity=".1"/>
                <path d="m829 477.5c-0.4 0.6-25.4 45.6-32 49s32-49 32-49z" enable-background="new    " opacity=".1"/>
                <path d="m827.8 494.5c0 1-24.4 53.2-28.4 53.8s28.4-53.8 28.4-53.8z" enable-background="new    " opacity=".1"/>
                <path d="m735 528.1s-11.8 25.2-16.4 26.6 16.4-26.6 16.4-26.6z" enable-background="new    " opacity=".1"/>
                <path d="m733 516.9s-4.1 8.8-6.5 8.8 6.5-8.8 6.5-8.8z" enable-background="new    " opacity=".1"/>
                <path d="m846.6 346.3c0 3.7-0.6 7.3-1.7 10.8-0.3 0.9-0.6 1.8-1 2.6-1.8-0.3-3.4-1-4.9-2.1-1.5-1-2.7-2.3-3.6-3.9-0.7-1.6-1.3-3.3-1.8-5-1.6-3.9-5.3-6.7-9.5-7.2 1.1 2-0.7 4.6-2.9 5-2.2 0.3-4.4-1-6-2.7s-2.7-3.7-4.2-5.4-3.7-3-6-2.7c-2 0.3-3.5 1.8-5.2 3-1.7 1.1-4 1.9-5.6 0.7-0.9-0.7-1.3-1.8-2.2-2.5-2.2-1.9-5.6 0.1-7.3 2.5-2.5 3.7-4 5.9-7.3 7.6v-0.6c0-19.1 15.5-34.6 34.6-34.6s34.6 15.4 34.6 34.5z" enable-background="new    " opacity=".1"/>
                <path d="m784.7 338.3c1.6-2.4 5.1-4.3 7.3-2.4 0.9 0.7 1.3 1.9 2.2 2.5 1.6 1.2 3.9 0.5 5.6-0.7s3.2-2.6 5.2-2.9c2.3-0.3 4.4 1 6 2.7s2.7 3.7 4.2 5.4 3.7 3 6 2.7 4.1-3 2.9-5c4.2 0.5 7.9 3.2 9.5 7.2 0.5 1.7 1.1 3.4 1.8 5 0.9 1.5 2.1 2.9 3.6 3.9 1.8 1.3 4.1 2.5 6.3 2.1s4.1-3 3.1-5c0.7 1.1 2.3-0.4 2.5-1.7 0.5-2.8 0.3-5.7-0.5-8.4-1.1-3.7-3.4-7.4-2.5-11.2 0.7-3 3.3-5.1 4.8-7.8 2.7-4.7 2-11-1.3-15.3-3.5-4.3-8.9-6.6-14.4-6.3-1.5 0.2-3 0.2-4.5 0.1-2.5-0.4-4.6-2-6.6-3.6l-16.8-13.1c-1.9-1.6-4-2.9-6.3-3.8-2.4-0.7-5.2-0.5-7 1.3-3.1 3.1-1.1 8.5-2.4 12.8-1.1 3.7-4.6 6.2-8.2 7.4s-7.5 1.5-11.3 2.4c-1.1 0.2-2.2 0.7-3 1.4-1 1.2-1.4 2.7-1.3 4.3 0 3.8 0.9 7.5 2.6 10.8 1.9 3.7 5 7.6 3.9 11.6-0.6 2.1-2.2 3.8-3.7 5.5-3.2 3.6-4.2 9 1.7 7.1 5.7-1.9 7.4-4.2 10.6-9z" fill="#434175"/>
                <g opacity=".1">
                            <path d="m850.9 348.1c-0.2 1.3-1.8 2.8-2.5 1.7 1 2-0.9 4.6-3.1 5s-4.5-0.7-6.3-2.1c-1.5-1-2.7-2.3-3.6-3.9-0.7-1.6-1.3-3.3-1.8-5-1.6-3.9-5.3-6.7-9.5-7.2 1.2 2-0.7 4.7-2.9 5s-4.4-1-6-2.7-2.7-3.7-4.2-5.4-3.7-3-6-2.7c-2 0.3-3.5 1.8-5.2 2.9s-4 1.9-5.6 0.7c-0.9-0.7-1.3-1.8-2.2-2.5-2.2-1.9-5.7 0.1-7.3 2.4-3.2 4.8-4.8 7.1-10.6 8.9-1.9 0.6-3.1 0.5-3.7-0.1-1.3 2.9-0.7 5.4 3.7 4.1 5.7-1.8 7.3-4.2 10.6-8.9 1.6-2.4 5.1-4.3 7.3-2.4 0.9 0.7 1.3 1.9 2.2 2.5 1.6 1.2 3.9 0.5 5.6-0.7s3.2-2.6 5.2-2.9c2.3-0.3 4.4 1 6 2.7s2.7 3.7 4.2 5.4 3.7 3 6 2.7 4.1-3 2.9-5c4.2 0.5 7.9 3.2 9.5 7.2 0.5 1.7 1.1 3.4 1.8 5 0.9 1.5 2.1 2.9 3.6 3.9 1.8 1.3 4.1 2.5 6.3 2.1s4.1-3 3.1-5c0.7 1.1 2.3-0.4 2.5-1.7 0.3-1.7 0.4-3.5 0.2-5.2-0.1 0.3-0.2 0.7-0.2 1.2z"/>
                  <path d="m776 330.8c0-0.1 0-0.1 0.1-0.2 1.1-4.1-2-7.9-3.9-11.6-1.4-2.6-2.2-5.5-2.5-8.4-0.1 0.5-0.1 1-0.1 1.6 0 3.8 0.9 7.5 2.6 10.8 1.3 2.5 3.1 5.1 3.8 7.8z"/>
                  <path d="m852.7 320.7c-1.5 2.7-4.1 4.8-4.8 7.8-0.3 1.3-0.3 2.6 0 3.8 0.7-2.9 3.2-5.1 4.8-7.7 1.4-2.6 2-5.5 1.5-8.4-0.2 1.5-0.7 3.1-1.5 4.5z"/>
                        </g>
                <path d="m729.8 501.5c0.3 1.1 0.5 2.2 0.6 3.4 0 0 15.8 37 17.8 39.2 0.6 0.7 2.9 4 5.9 8.3 1.1 1.5 2.2 3.2 3.3 4.9l12.8 19.2 14.8 13s32.2 2.6 42.4-7.9c-1.2-0.9-2-1.3-2-1.3l-4.4-3.4c-2.3-3.8-11-7.6-19.8-10.5-8.1 0.1-14.7 0.7-14.7 0.7l-2.1-5.6-2.2-5.8-11.2-29.4s-7.2-37.2-9.6-39-1.8-7.4-1.8-7.4 4.4-15.8 2.8-18 2.6-18.4 2.6-18.4c-0.4-1.6-1.1-3.1-1.9-4.5l-30.9 58.7s-1.1 1.6-2.4 3.8z" enable-background="new    " opacity=".1"/>
                <path d="m765.4 442.3s-4.2 16.2-2.6 18.4-2.8 18-2.8 18-0.6 5.6 1.8 7.4 9.6 39 9.6 39l15.5 40.8s48.5-4.8 43.5 10.4-45 12-45 12l-14.8-13s-20-30.2-22-32.4-17.8-39.2-17.8-39.2-0.8-7.4-4.2-11.2-0.8-10.2-0.8-10.2-4.2-48.4 0.2-54.2 34.8-3.2 39.4 14.2z" fill="#EE8E9E"/>
                <path d="m740.6 411.9l-12.6 7.6s-3.6 12.2-6.4 13.8c0 0 25.2-14 44.2 18.2 0 0-0.6-4.2 2-6.2s2-10.6 2-10.6c0.7-1.4 1.3-2.8 1.8-4.2 1.8-4.4-7.6-29.6-31-18.6z" enable-background="new    " opacity=".1"/>
                <path d="m740.2 411.1l-12.6 7.6s-3.6 12.2-6.4 13.8c0 0 25.2-14 44.2 18.2 0 0-0.6-4.2 2-6.2s2-10.6 2-10.6c0.7-1.4 1.3-2.8 1.8-4.2 1.8-4.4-7.6-29.6-31-18.6z" fill="#434175"/>
                <ellipse cx="627.9" cy="721.4" rx="37.6" ry="39.9" fill="#FBD56F"/>
                <ellipse cx="627.9" cy="721.4" rx="37.6" ry="39.9" enable-background="new    " opacity=".1"/>
                <ellipse cx="634.4" cy="722.3" rx="37.6" ry="39" fill="#FBD56F"/>
                <path d="m509.6 684.3c2.1 2.8 3.8 5.9 5 9.2 0.3 0.8 0.7 1.7 1 2.7 5 14.9-2.9 32.8-5.2 30.9s-9.3-5.5-10.7-0.5-6.4 10.2-6.4 10.2c-9.2 9.2-17.5-0.7-22.9-11.1-1.8-3.4-3.4-6.9-4.7-10.5-1.2-3.2-1.9-5.4-1.9-5.4l38.2-32.6c0 0.1 3.7 1.8 7.6 7.1z" fill="#2A4365"/>
                <path d="m449.4 705.2c2.1 2.8 3.8 5.9 5 9.2 0.3 0.8 0.7 1.7 1 2.7 5 14.9-2.9 32.8-5.2 30.9s-9.3-5.5-10.7-0.5-6.4 10.2-6.4 10.2c-9.2 9.2-17.5-0.7-22.9-11.1-1.8-3.4-3.4-6.9-4.7-10.5-1.2-3.2-1.9-5.4-1.9-5.4l38.2-32.6c-0.1 0.1 3.6 1.8 7.6 7.1z" fill="#2A4365"/>
                <path d="m328.4 734c-0.2 3.5-0.9 7-2 10.3l-0.9 2.7c-5.7 14.7-23.2 23.4-23.7 20.5s-3.7-10.2-7.9-7.2-11.4 3.8-11.4 3.8c-13 1.2-13-11.7-10.6-23.2 0.8-3.8 1.8-7.5 3-11.1 1.1-3.2 1.9-5.3 1.9-5.3l50.2-0.7c0-0.1 1.7 3.6 1.4 10.2z" fill="#2A4365"/>
                <path d="m263.5 717.6c-0.2 3.5-0.9 7-2 10.3l-0.9 2.7c-5.7 14.7-23.2 23.4-23.7 20.5s-3.7-10.2-7.9-7.2-11.4 3.8-11.4 3.8c-13 1.2-13-11.7-10.6-23.2 0.8-3.8 1.8-7.5 3-11.1 1.1-3.2 1.9-5.3 1.9-5.3l50.2-0.7c0-0.1 1.7 3.6 1.4 10.2z" fill="#2A4365"/>
                <path d="m509.6 684.3c2.1 2.8 3.8 5.9 5 9.2 0.3 0.8 0.7 1.7 1 2.7 5 14.9-2.9 32.8-5.2 30.9s-9.3-5.5-10.7-0.5-6.4 10.2-6.4 10.2c-9.2 9.2-17.5-0.7-22.9-11.1-1.8-3.4-3.4-6.9-4.7-10.5-1.2-3.2-1.9-5.4-1.9-5.4l38.2-32.6c0 0.1 3.7 1.8 7.6 7.1z" enable-background="new    " opacity=".2"/>
                <path d="m449.4 705.2c2.1 2.8 3.8 5.9 5 9.2 0.3 0.8 0.7 1.7 1 2.7 5 14.9-2.9 32.8-5.2 30.9s-9.3-5.5-10.7-0.5-6.4 10.2-6.4 10.2c-9.2 9.2-17.5-0.7-22.9-11.1-1.8-3.4-3.4-6.9-4.7-10.5-1.2-3.2-1.9-5.4-1.9-5.4l38.2-32.6c-0.1 0.1 3.6 1.8 7.6 7.1z" enable-background="new    " opacity=".2"/>
                <path d="m328.4 734c-0.2 3.5-0.9 7-2 10.3l-0.9 2.7c-5.7 14.7-23.2 23.4-23.7 20.5s-3.7-10.2-7.9-7.2-11.4 3.8-11.4 3.8c-13 1.2-13-11.7-10.6-23.2 0.8-3.8 1.8-7.5 3-11.1 1.1-3.2 1.9-5.3 1.9-5.3l50.2-0.7c0-0.1 1.7 3.6 1.4 10.2z" enable-background="new    " opacity=".2"/>
                <path d="m263.5 717.6c-0.2 3.5-0.9 7-2 10.3l-0.9 2.7c-5.7 14.7-23.2 23.4-23.7 20.5s-3.7-10.2-7.9-7.2-11.4 3.8-11.4 3.8c-13 1.2-13-11.7-10.6-23.2 0.8-3.8 1.8-7.5 3-11.1 1.1-3.2 1.9-5.3 1.9-5.3l50.2-0.7c0-0.1 1.7 3.6 1.4 10.2z" enable-background="new    " opacity=".2"/>
                <path d="m611.6 497.5c0 134.2-45.4 242.9-254.8 242.9-140.7 0-249.6-35-254.8-242.9-3.4-134.1 114.1-242.9 254.8-242.9s254.8 108.7 254.8 242.9z" fill="#2A4365"/>
                <path d="m309 258.8z" enable-background="new    " opacity=".2"/>
                <path d="m309.5 258.7c0.6-0.1 1.9-0.3 3.8-0.4l-4.1 0.5h0.2c0-0.1 0-0.1 0.1-0.1z" enable-background="new    " opacity=".2"/>
                <path d="m497.8 358l-18.6 6.7c-9.5-12.7-19.7-24.9-30.6-36.4-11.9-12.7-24.8-24.3-38.7-34.7-47.6-35.3-84.5-36.2-96.6-35.3l28-3.3c26.4 4.5 51.8 13.7 75.1 27.1 16.2 9.4 31.4 20.5 45.1 33.3 24.3 22.6 36.3 42.6 36.3 42.6z" enable-background="new    " opacity=".2"/>
                <path d="m329.6 370.6s-24.6-81.8-3.7-104.2c0 0 32.7-11.2 57.3 52.1l-53.6 52.1z" enable-background="new    " opacity=".2"/>
                <path d="m454 294.2s65.1-55.3 93.9-45.2c0 0 23.4 25.5-24.7 73.4l-69.2-28.2z" fill="#2A4365"/>
                <path d="m454 294.2s65.1-55.3 93.9-45.2c0 0 23.4 25.5-24.7 73.4l-69.2-28.2z" enable-background="new    " opacity=".2"/>
                <path d="m657 559.2c0 72.1-51.7 129.1-100.4 129.1s-75.9-57-75.9-129.1 39.6-127.8 88.2-130.6c76.9-4.4 88.1 58.5 88.1 130.6z" fill="#2A4365"/>
                <path d="m657 559.2c0 72.1-51.7 129.1-100.4 129.1s-75.9-57-75.9-129.1 39.6-127.8 88.2-130.6c76.9-4.4 88.1 58.5 88.1 130.6z" enable-background="new    " opacity=".2"/>
                <ellipse cx="553.6" cy="570" rx="16.4" ry="20.8" fill="#2A4365"/>
                <ellipse cx="611.6" cy="552.1" rx="16.4" ry="20.8" fill="#2A4365"/>
                <path d="m464.6 302c0 4.7-1.1 9.3-3.2 13.4-2.8 5.5-7.3 10-12.8 12.8-11.9-12.7-24.8-24.3-38.7-34.7 1.2-4.3 3.4-8.2 6.4-11.4 5.2-5.8 12.6-9.1 20.3-9.1 15.5 0 28 13 28 29z" fill="#FAD46F"/>
</svg>
            </div>
          </div>
        </template>

      </div>

      <create-edit-modal v-if="modalIsOpen" @newBucket="addNewBucket" @close="modalIsOpen = false"/>
    </template>

    <template v-else>Loading...</template>
  </div>
</template>

<script>
  import BucketListItem from "./BucketListItem";
  import CreateEditModal from "./CreateEditModal";
  import Modal from "../Shared/Modal";

  export default {
    name: "Buckets",
    components: {Modal, CreateEditModal, BucketListItem},
    data() {
      return {
        loading: true,
        modalIsOpen: false,
        buckets: {
          data: [],
        },
      }
    },

    created() {
      this.fetchData();
    },

    methods: {
      /**
       * Fetch user's buckets from server
       * @return void
       */
      fetchData() {
        this.loading = true;

        axios(route('api.expense-report.buckets.index').url())
          .then(response => {
            this.buckets = response.data;
            this.loading = false;
          })
          .catch(error => {
            console.log(error.data);
            this.loading = false;
          })
      },

      /**
       * Add bucket to the list of buckets - event triggered in CreateEditModal
       * @param bucket
       * @return void
       */
      addNewBucket(bucket) {
        if (this.buckets.current_page === 1) {
          this.buckets.data.unshift(bucket);
        }
      },
    },
  }
</script>

