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
                <p class="text-center py-10 text-xl font-semibold text-gray-300">2. PAY VIA ONLINE</p>
            </div>

            <div class="flex justify-center items-center w-1/2 bg-gray-800 rounded-md p-8 mx-auto mb-5">
                <form class="w-full">
                <div class="text-gray-300">
                <div class="space-y-5 mt-4">
                    <div class="flex justify-between items-center">
                        <span class="font-semibold text-lg">Name: </span>
                        <span>Nwoko James</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="font-semibold text-lg">Email: </span>
                        <span>nwokojames@james.com</span>
                    </div>
                    
                        <div>
                            <label for="description">Description</label>
                            <input type="text" placeholder="Payment for ... ?" name="description">
                        </div>
                        <div>
                            <label for="description">Amount</label>
                            <input type="text" placeholder="Amount to pay" name="amount">
                        </div>

                    <div class="flex justify-center items-center">
                    <input type="button"  class="inline-block border border-black px-8 py-2 mt-5 rounded-md" value="Pay">
                    </div>
                </div>
                </form>
            </div>

          </div>
        </main>

    </UserDashboard>
</template>