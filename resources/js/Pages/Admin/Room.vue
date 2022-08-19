<script setup>
import { Head, Link } from '@inertiajs/inertia-vue3';
import Dashboard from '@/Layouts/AdminDashboard.vue';
import { reactive } from 'vue';

const props = defineProps({
    users: Object,
    id: Number,
});

</script>

<template>
    <Dashboard>
        <Head title="Change of Room" />
        <main class="h-full overflow-y-auto z-30">
          <div class="container px-6 mx-auto ">
            <h2
              class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200"
            >
              Here are occupants of this room. 
            </h2>

            <div>
              <div class="w-full overflow-hidden rounded-lg shadow-xs pb-10">
                <div class="w-full overflow-x-auto">
                  <table class="w-full whitespace-no-wrap">
                    <thead>
                      <tr
                        class="font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-300 dark:bg-gray-800"
                      >
                        <th class="px-4 py-3">Name</th>
                        <th class="px-4 py-3">Email</th>
                        <th class="px-4 py-3">Gender</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3">Room No</th>
                        <th class="px-4 py-3">Actions</th>
                      </tr>
                    </thead>
                    <tbody
                      class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800"
                    >
                      <tr v-for="user in users" :key="user.id" class="text-gray-700 dark:text-gray-400">
                        <td class="px-4 py-3 text-sm">
                          {{ user.name }}
                        </td>
                        <td class="px-4 py-3 text-sm">
                          {{ user.email }}
                        </td>
                        <td class="px-4 py-3 text-sm">
                          {{ user.gender }}
                        </td>
                        <td class="px-4 py-3 text-sm font-semibold text-green-300">
                          <div class="flex justify-between">
                            Active
                          </div>
                        </td>
                        <td class="px-4 py-3 text-sm">
                          {{ user.room_no ?? 'NULL' }}
                        </td>
                        <td class="px-4 py-3">
                          <div class="flex items-center space-x-4 text-sm">
                            <Link
                              :href="route('admin.room.tenant', user.id)"
                              class="flex items-center justify-between px-2 py-2 text-sm font-semibold leading-5 text-purple-600 rounded-lg dark:text-green-200 dark:bg-green-700 focus:outline-none focus:shadow-outline-gray"
                            >
                              Change Room No
                            </Link>            
                          </div>
                        </td>
                      </tr>
                    </tbody>
                  </table>

                  <div class="flex justify-end mt-4">
                    <Link :href="route('admin.change.room', props.id)" class="px-8 cursor-pointer py-3 inline-block font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                      Change at once
                    </Link>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </main>
       
    </Dashboard>
</template>