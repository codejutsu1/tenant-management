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
              <h1 class="font-semibold text-3xl text-center text-gray-400">House/Lodge Payment</h1>
            </div>

            <slot />

          </div>
        </main>

    </UserDashboard>
</template>