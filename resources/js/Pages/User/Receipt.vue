<script setup>
import { Head, Link } from '@inertiajs/inertia-vue3';
import UserDashboard from '@/Layouts/UserDashboard.vue';
import Pagination from '@/Components/Pagination.vue';

const props = defineProps({
  transactions: Object,
});

</script>

<template>
    <UserDashboard>
        <Head title="Receipt" />

        <main class="h-full overflow-y-auto z-30">
          <div class="container px-6 mx-auto grid">
            <h2
              class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200"
            >
              View your Receipt
            </h2>

            <!-- New Table -->
            <div class="w-full overflow-hidden rounded-lg shadow-xs">
              <div class="w-full overflow-x-auto">
                <table class="w-full whitespace-no-wrap">
                  <thead>
                    <tr
                      class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800"
                    >
                      <th class="px-4 py-3">Room No.</th>
                      <th class="px-4 py-3">Title</th>
                      <th class="px-4 py-3">Amount</th>
                      <th class="px-4 py-3">Year</th>
                      <th class="px-4 py-3 text-center">Actions</th>
                      <th class="px-4 py-3">Date</th>
                    </tr>
                  </thead>
                  <tbody
                    class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800"
                  >
                    <tr v-for="transaction in transactions.data" :key="transaction.id" class="text-gray-700 dark:text-gray-400">
                      <td class="px-4 py-3">
                        <div class="flex items-center text-sm">
                          {{ transaction.user.room_no ?? 'NULL' }}
                        </div>
                      </td>
                      <td class="px-4 py-3 text-sm">
                        {{ transaction.title }}
                      </td>
                      <td class="px-4 py-3 text-sm">
                        &#8358; {{ transaction.amount }}
                      </td>
                      <td class="px-4 py-3 text-sm">
                        {{ transaction.year }}
                      </td>
                      <td class="px-4 py-3 text-xs">
                        <div class="flex justify-center items-center">
                          <a
                            target="_blank"
                            class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100"
                            :href="'/storage/' + transaction.link"
                          >
                            View
                          </a>
                        </div>
                      </td>
                      <td class="px-4 py-3 text-sm">
                        {{ transaction.created_at }}
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>

              <div
                  class="flex justify-center items-center mt-6 px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-gray-50 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800"
              >
                  <Pagination :links="transactions.links" />
              </div>

            </div>
          </div>
        </main>
    </UserDashboard>
</template>