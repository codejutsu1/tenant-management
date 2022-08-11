    <script setup>
import { Head, Link } from '@inertiajs/inertia-vue3';
import Dashboard from '@/Layouts/AdminDashboard.vue';
import { reactive } from 'vue';

const props = defineProps({
    users: Object,
});

</script>

<template>
    <Dashboard>
        <Head title="All Users" />
        <main class="h-full overflow-y-auto z-30">
          <div class="container px-6 mx-auto grid">
            <h2
              class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200"
            >
              Here are list of active users.
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
                      <th class="px-4 py-3">Room No</th>
                      <th class="px-4 py-3">Action</th>
                      <th class="px-4 py-3">Date Ent.</th>
                      <th class="px-4 py-3">Date Ext.</th>
                    </tr>
                  </thead>
                  <tbody
                    class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800"
                  >
                    <tr v-for="user in users.data" :key="user.id" class="text-gray-700 dark:text-gray-400">
                      <td class="px-4 py-3 text-sm">
                        <Link :href="route('tenants.show', user.id)">
                          {{ user.name }}
                        </Link>
                      </td>
                      <td class="px-4 py-3 text-sm">
                        {{ user.email }}
                      </td>
                      <td class="px-4 py-3 text-sm">
                        {{ user.gender }}
                      </td>
                      <td class="px-4 py-3 text-sm">
                        {{ user.room_no }}
                      </td>
                      <td class="px-4 py-3">
                        <div class="flex items-center space-x-4 text-sm">
                          <button
                            type="button"
                            class="flex items-center justify-between px-2 py-2 text-sm font-semibold leading-5  rounded-lg text-green-200 bg-green-700 focus:outline-none focus:shadow-outline-gray"
                            aria-label="Edit"
                          >
                            Activate
                          </button>            
                        </div>
                      </td>
                      <td class="px-4 py-3 text-sm">
                        {{ user.created_at }}
                      </td>
                      <td class="px-4 py-3 text-sm">
                        Till Date
                      </td>
                    </tr>
                    <tr class="text-gray-700 dark:text-gray-400">
                      <td class="px-4 py-3 text-sm">
                        Okoro John
                      </td>
                      <td class="px-4 py-3 text-sm">
                        okorojohn@john.com
                      </td>
                      <td class="px-4 py-3 text-sm">
                        Male
                      </td>
                      <td class="px-4 py-3 text-sm">
                        10
                      </td>
                      <td class="px-4 py-3">
                        <div class="flex items-center space-x-4 text-sm">
                          <button
                            type="button"
                            class="flex items-center justify-between px-2 py-2 text-sm font-semibold leading-5  rounded-lg text-red-200 bg-red-700 focus:outline-none focus:shadow-outline-gray"
                            aria-label="Edit"
                          >
                            Deactivate
                          </button>            
                        </div>
                      </td>
                      <td class="px-4 py-3 text-sm">
                        10th July, 2008
                      </td>
                      <td class="px-4 py-3 text-sm">
                        Till Date
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- pagination -->
              <!-- <div
                  class="flex justify-center items-center mt-6 px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-gray-50 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800"
              >
              </div> -->
            </div>
            </div>
          </div>
        </main>
       
    </Dashboard>
</template>