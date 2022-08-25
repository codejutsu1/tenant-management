<script setup>
import { Head, Link } from '@inertiajs/inertia-vue3';
import UserDashboard from '@/Layouts/UserDashboard.vue';
import Notification from '@/Components/Notification.vue';

const props = defineProps({
    user: Object,
    caretakers: Object
});

</script>

<template>
    <div v-if="$page.props.flash.message" class="absolute top-8 right-10 z-40">
        <Notification :message="$page.props.flash.message" />
    </div>
    
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
                        <Link :href="route('user.edits')" type="button" class="px-8 cursor-pointer py-3 inline-block font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">Edit</Link>
                        <button type="button" class="px-8 cursor-pointer py-3 inline-block font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">Delete</button>
                    </li>
                </ul>
            </div>

            <div class="bg-gray-800 px-6 py-6 my-10 w-full md:w-5/6 mx-auto rounded-md">
                <table class="w-full whitespace-no-wrap">
                  <thead>
                    <tr
                      class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800"
                    >
                      <th class="px-4 py-3">Name</th>
                      <th class="px-4 py-3">Role</th>
                      <th class="px-4 py-3">Gender</th>
                      <th class="px-4 py-3">Email</th>
                      <th class="px-4 py-3">Phone</th>
                    </tr>
                  </thead>
                  <tbody
                    class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800"
                  >
                    <tr v-for="user in caretakers" :key="user.id" class="text-gray-700 dark:text-gray-400">
                      <td class="px-4 py-3">
                        <div class="flex items-center text-sm">
                          {{ user.name }}
                        </div>
                      </td>
                      <td class="px-4 py-3 text-sm">
                        Caretaker 
                      </td>
                      <td class="px-4 py-3 text-sm">
                        {{ user.gender }}
                      </td>
                      <td class="px-4 py-3 text-sm underline">
                        <a :href="'mailto:' + user.email">{{ user.email }}</a>
                      </td>
                      <td class="px-4 py-3 text-sm underline">
                        <a :href="'tel:' + user.phone">{{ user.phone }}</a>
                      </td>
                    </tr>
                  </tbody>
                </table>
            </div>
        </main>

    </UserDashboard>
</template>