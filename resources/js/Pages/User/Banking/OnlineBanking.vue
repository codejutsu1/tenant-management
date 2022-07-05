<script setup>
import Payment from '@/Components/Pay.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';

</script>

<template>
    <Head />
    
    <Payment>
      <div>
        <p class="text-center py-10 text-xl font-semibold text-gray-300">2. PAY VIA ONLINE</p>
      </div>

      <div class="flex justify-center items-center w-1/2 bg-gray-800 rounded-md p-8 mx-auto mb-5">
        <form class="w-full">
          <div class="text-gray-300">
            <h1 class="text-4xl text-center font-semibold">&#8358; 120,000.00</h1>
            <div class="space-y-5 mt-4">
              <div class="flex justify-between items-center">
                <span class="font-semibold text-lg">Name: </span>
                <span>Nwoko James</span>
              </div>
              <div class="flex justify-between items-center">
                <span class="font-semibold text-lg">Email: </span>
                <span>nwokojames@james.com</span>
              </div>
              <div class="flex justify-between items-center">
                <span class="font-semibold text-lg">Payment for: </span>
                <span>House/Lodge</span>
              </div>
            </div>

            <div class="flex justify-center items-center">
              <input type="button"  class="inline-block border border-black px-8 py-2 mt-5 rounded-md" value="Pay">
            </div>
          </div>
        </form>
      </div>
    </Payment>
</template>