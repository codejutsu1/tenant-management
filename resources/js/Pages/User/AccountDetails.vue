<script setup>
import { Head, Link } from '@inertiajs/inertia-vue3';
import UserDashboard from '@/Layouts/UserDashboard.vue';

const props = defineProps({
    user: Object,
});

</script>

<template>
    <UserDashboard>
        <Head title="Account" />

        <main class="h-full overflow-y-auto z-30">
          <div class="container px-6 mx-auto grid">
            <h2
              class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200"
            >
              Account Details
            </h2>
          </div>

          <div class="bg-gray-800 px-6 py-10 w-full md:w-3/5 mx-auto rounded-md">
            <ul class="text-lg text-gray-200 font-semibold tracking-wider">
                <li class="flex justify-between pb-6 border-b border-b-gray-100">
                    <span>Name</span>
                    <span>{{ user.name }}</span>
                </li>
                <li class="flex justify-between py-4 border-b border-b-gray-100">
                    <span>Email</span>
                    <span>{{ user.email }}</span>
                </li>
                <li class="flex justify-between py-4 border-b border-b-gray-100">
                    <span>Type</span>
                    <span>{{ user.type }}</span>
                </li>
                <li class="flex justify-between py-4 border-b border-b-gray-100">
                    <span>LGA</span>
                    <span>{{ user.lga }}</span>
                </li>
                <li class="flex justify-between py-4 border-b border-b-gray-100">
                    <span>State</span>
                    <span>{{ user.state }}</span>
                </li>
                <li class="flex justify-between py-4 border-b border-b-gray-100">
                    <span>Gender</span>
                    <span>{{ user.gender }}</span>
                </li>
                <li class="flex justify-between py-4 border-b border-b-gray-100">
                    <span>Occupation</span>
                    <span>{{ user.occupation }}</span>
                </li>
                <li class="flex justify-between py-4 border-b border-b-gray-100">
                    <span>Room No</span>
                    <span>{{ user.room_no }}</span>
                </li>
                <li class="flex justify-between py-4 border-b border-b-gray-100">
                    <span>Date</span>
                    <span>08 January 2016</span>
                </li>
                <li class="flex justify-between py-4 border-b border-b-gray-100">
                    <button type="button" class="px-8 cursor-pointer py-3 inline-block font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">Edit</button>
                    <button type="button" class="px-8 cursor-pointer py-3 inline-block font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">Delete</button>
                </li>
            </ul>
        </div>
        </main>

    </UserDashboard>
</template>