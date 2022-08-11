<script setup>
import { Head, Link } from '@inertiajs/inertia-vue3';
import Dashboard from '@/Layouts/AdminDashboard.vue';
import Pagination from '@/Components/Pagination.vue';
import Notification from '@/Components/Notification.vue';

const props = defineProps({
  transactions: Object,    
});

</script>

<template>
    <div v-if="$page.props.flash.message" class="absolute top-8 right-10 z-40">
        <Notification :message="$page.props.flash.message" />
    </div>

    <Dashboard>
        <Head title="New Payment" />
        <main class="h-full overflow-y-auto z-30">
          <div class="container px-6 mx-auto grid">
            <h2
              class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200"
            >
              Here are all payments, you can reconfirm or decline.
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
                      <th class="px-4 py-3">Room No</th>
                      <th class="px-4 py-3">Amount</th>
                      <th class="px-4 py-3">Description</th>
                      <th class="px-4 py-3">Status</th>
                      <th class="px-4 py-3">Report</th>
                      <th class="px-4 py-3">Date of Payment</th>
                      <th class="px-4 py-3">Actions</th>
                    </tr>
                  </thead>
                  <tbody
                    class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800"
                  >
                    <tr v-for="transaction in transactions.data" :key="transaction.id" class="text-gray-700 dark:text-gray-400">
                      <td class="px-4 py-3 text-sm">
                        <Link :href="route('tenants.show', transaction.user.id)">
                          {{ transaction.user.name }}
                        </Link>
                      </td>
                      <td class="px-4 py-3 text-sm">
                        {{ transaction.user.room_no }}
                      </td>
                      <td class="px-4 py-3 text-sm">
                        &#8358; {{ transaction.amount }}
                      </td>
                      <td class="px-4 py-3 text-sm">
                        {{ transaction.title }}
                      </td>
                      <td class="px-4 py-3 text-sm font-semibold text-green-300">
                        <div v-if="transaction.paid" class="flex justify-between">
                          Paid (Full)
                        </div>
                      </td>
                      <td class="px-4 py-3 text-sm">
                        <span 
                            v-if="transaction.status"
                            class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100"
                        >
                          Approved
                        </span>
                        <span
                            v-else-if="transaction.status == NULL"  
                            class="px-2 py-1 font-semibold leading-tight text-orange-700 bg-orange-100 rounded-full dark:text-white dark:bg-orange-600"
                        >
                          Pending
                        </span>
                        <span
                          v-else
                          class="px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-full dark:text-red-100 dark:bg-red-700"
                        >
                          Denied
                        </span>
                      </td>
                      <td class="px-4 py-3 text-sm">
                        {{ transaction.created_at }}
                      </td>
                      <td class="px-4 py-3">
                        <div class="flex items-center space-x-4 text-sm">
                          <Link
                          onclick="return confirm('Are you sure you want to confirm this transaction')"
                            :href="route('admin.confirm.payment', transaction.id)"
                            class="flex items-center justify-between px-2 py-2 text-sm font-semibold leading-5 text-purple-600 rounded-lg dark:text-green-200 dark:bg-green-700 focus:outline-none focus:shadow-outline-gray"
                            aria-label="Edit"
                          >
                            Confirm
                          </Link>
                          <Link
                            onclick="return confirm('Are you sure you want to reject this transaction')"
                            :href="route('admin.reject.payment', transaction.id)"
                            class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-red-700 focus:outline-none focus:shadow-outline-gray"
                            aria-label="Delete"
                          >
                            Decline
                          </Link>
                        </div>
                      </td>
                    </tr>
                    <tr class="text-gray-700 dark:text-gray-400">
                      <td class="px-4 py-3 text-sm">
                        Okoro John
                      </td>
                      <td class="px-4 py-3 text-sm">
                        4
                      </td>
                      <td class="px-4 py-3 text-sm">
                        &#8358; 180,000.00
                      </td>
                      <td class="px-4 py-3 text-sm">
                        Lodge Rent
                      </td>
                      <td class="px-4 py-3 text-sm font-semibold text-green-300">
                        <div class="flex justify-between">
                          Paid (Full)
                        </div>
                      </td>
                      <td class="px-4 py-3 text-sm">
                        <span
                            class="px-2 py-1 font-semibold leading-tight text-orange-700 bg-orange-100 rounded-full dark:text-white dark:bg-orange-600"
                        >
                          Pending
                        </span>
                      </td>
                      <td class="px-4 py-3 text-sm">
                        16th October, 2001
                      </td>
                      <td class="px-4 py-3">
                        <div class="flex items-center space-x-4 text-sm">
                          <Link
                            class="flex items-center justify-between px-2 py-2 text-sm font-semibold leading-5 text-purple-600 rounded-lg dark:text-green-200 dark:bg-green-700 focus:outline-none focus:shadow-outline-gray"
                            aria-label="Edit"
                          >
                            Confirm
                          </Link>
                          <Link
                            class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-red-700 focus:outline-none focus:shadow-outline-gray"
                            aria-label="Delete"
                          >
                            <svg
                              class="w-5 h-5"
                              aria-hidden="true"
                              fill="currentColor"
                              viewBox="0 0 20 20"
                            >
                              <path
                                fill-rule="evenodd"
                                d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                clip-rule="evenodd"
                              ></path>
                            </svg>
                          </Link>
                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- pagination -->
              <div
                  class="flex justify-center items-center mt-6 px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-gray-50 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800"
              >
                  <Pagination :links="transactions.links" />
              </div>
            </div>
            </div>
          </div>
        </main>
       
    </Dashboard>
</template>