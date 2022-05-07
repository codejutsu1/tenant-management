<script setup>
import Payment from '@/Components/Pay.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';

</script>

<template>
    <Payment>
      <div class="bg-gray-800 rounded-md py-8">
        <h1 class="font-semibold text-3xl text-center text-gray-400">House/Lodge Payment</h1>
      </div>

      <div>
        <p class="text-center py-10 text-xl font-semibold text-gray-300">1. CHOOSE A PAYMENT METHOD</p>
        <div class="grid grid-cols-3 justify-center gap-7">
          <Link :href="route('onlineBanking')" class="flex justify-center items-center bg-gray-800 rounded-md py-8">
            <p class="font-semibold text-lg text-gray-400 tracking-wider">Online Banking</p>
          </Link>
          <Link :href="route('offlineBanking')" class="flex justify-center items-center bg-gray-800 rounded-md py-8">
            <p class="font-semibold text-lg text-gray-400 tracking-wider">Offline Banking</p>
          </Link>
          <Link :href="route('crypto')" class="flex justify-center items-center bg-gray-800 rounded-md py-8">
            <p class="font-semibold text-lg text-gray-400 tracking-wider">Crypto Currency</p>
          </Link>
        </div>
      </div>
    </Payment>
</template>