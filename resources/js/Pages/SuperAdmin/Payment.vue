<script setup>
import { Head, Link } from '@inertiajs/inertia-vue3';
import Dashboard from '@/Layouts/SuperAdminDashboard.vue';
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
              Here are new payments, you can confirm or decline.
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
                        {{ transaction.created_at }}
                      </td>
                      <td class="px-4 py-3">
                        <div class="flex items-center space-x-4 text-sm">
                          <Link
                          onclick="return confirm('Are you sure you want to confirm this transaction')"
                            :href="route('confirm.payment', transaction.id)"
                            class="flex items-center justify-between px-2 py-2 text-sm font-semibold leading-5 text-purple-600 rounded-lg dark:text-green-200 dark:bg-green-700 focus:outline-none focus:shadow-outline-gray"
                            aria-label="Edit"
                          >
                            Confirm
                          </Link>
                          <Link
                            onclick="return confirm('Are you sure you want to reject this transaction')"
                            :href="route('reject.payment', transaction.id)"
                            class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-red-700 focus:outline-none focus:shadow-outline-gray"
                            aria-label="Delete"
                          >
                            Decline
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