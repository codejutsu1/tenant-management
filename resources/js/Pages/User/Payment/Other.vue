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
              <p class="text-center py-10 text-xl font-semibold text-gray-300">1. CHOOSE A PAYMENT METHOD</p>
              <div class="md:grid grid-cols-3 justify-center gap-7 space-y-6 md:space-y-0">
                <Link :href="route('other.online.banking')" class="flex justify-center items-center bg-gray-800 rounded-md py-8">
                  <p class="font-semibold text-lg text-gray-400 tracking-wider">Online Banking</p>
                </Link>
                <Link :href="route('offline.banking')" class="flex justify-center items-center bg-gray-800 rounded-md py-8">
                  <p class="font-semibold text-lg text-gray-400 tracking-wider">Offline Banking</p>
                </Link>
                <Link :href="route('crypto')" class="flex justify-center items-center bg-gray-800 rounded-md py-8">
                  <p class="font-semibold text-lg text-gray-400 tracking-wider">Crypto Currency</p>
                </Link>
              </div>
            </div>
          </div>
        </main>

    </UserDashboard>
</template>