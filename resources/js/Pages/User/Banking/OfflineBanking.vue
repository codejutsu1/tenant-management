<script setup>
import Payment from '@/Components/Pay.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';

</script>

<template>
    <Payment>
      <div>
        <p class="text-center py-10 text-xl font-semibold text-gray-300">2. PAY VIA BANKING</p>
      </div>

      <div class="w-1/2 bg-gray-800 rounded-md mx-auto mb-5">
          <div class="text-gray-300 space-y-2 mt-4">
             <div class="p-8">
               <span class="mb-2">
                 Account Name:
               </span>
               <span class="block border border-gray-400 py-2 text-xl px-2">
                 Nwokoro James Okafor
               </span>
             </div>
             <div class="p-8">
               <span class="mb-2">
                 Account Number:
               </span>
               <span class="block border border-gray-400 py-2 text-xl px-2">
                 2134558383
               </span>
               <span class="block mt-2 text-sm"> 
                 Click on the above box to copy.
               </span>
             </div>
             <div class="p-8">
               <span class="mb-2">
                 Bank Name:
               </span>
               <span class="block border border-gray-400 py-2 text-xl px-2">
                 First Bank of Nigeria
               </span>
             </div>
          </div>
      </div>
    </Payment>
</template>