<script setup>
import { Head, Link } from '@inertiajs/inertia-vue3';
import UserDashboard from '@/Layouts/UserDashboard.vue';

</script>

<template>
    <UserDashboard>
        <Head title="Payment" />

        <main class="h-full overflow-y-auto z-30">
          <div class="container px-6 mx-auto grid">
            <h2
              class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200"
            >
              Make Payment
            </h2>

            <div class="bg-gray-800 rounded-md py-8">
              <h1 class="font-semibold text-3xl text-center text-gray-400">Other Payment</h1>
            </div>

            <div>
        <p class="text-center py-10 text-xl font-semibold text-gray-300">2. PAY VIA CYPTOCURRENCY</p>
      </div>

      <div class="w-1/2 bg-gray-800 rounded-md mx-auto mb-5">
          <div class="text-gray-300 space-y-2 mt-4">
             <div class="p-8">
               <span class="mb-2">
                 Coin:
               </span>
               <span class="block border border-gray-400 py-2 text-xl px-2">
                  Bitcoin (BTC)
               </span>
             </div>
             <div class="p-8">
               <span class="mb-2">
                 Address:
               </span>
               <span class="block border border-gray-400 py-2 text-xl px-2">
                 jabjhbhjdbhwww32343
               </span>
               <span class="block mt-2 text-sm"> 
                 Click on the above box to copy.
               </span>
             </div>
             <form> 
                 <label for="amount">Amount</label>
                 <input type="text" name="amount" id="amount">
             </form>
          </div>
      </div>

          </div>
        </main>

    </UserDashboard>
</template>