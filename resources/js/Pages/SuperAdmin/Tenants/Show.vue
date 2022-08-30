<script setup>
import { Head, Link } from '@inertiajs/inertia-vue3';
import UserDashboard from '@/Layouts/SuperAdminDashboard.vue';
import Notification from '@/Components/Notification.vue';
import { Inertia } from '@inertiajs/inertia';

const props = defineProps({
    user: Object,
    transactions: Object,
    receipts: Object,
    legals: Object,
});

const destroy = (id) => {
  if(confirm('Are you sure?')){
    Inertia.delete(route('tenants.destroy', id));
  }

  return { destroy }
}

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
                    <span>{{ user.room_no ?? 'NULL' }}</span>
                </li>
                <li class="flex justify-between py-4 border-b border-b-gray-100">
                    <span>Date</span>
                    <span>{{ user.created_at ?? 'NULL' }}</span>
                </li>
                <li class="flex justify-between py-4 border-b border-b-gray-100">
                    <Link :href="route('tenants.edit',  user.id)" type="button" class="px-8 cursor-pointer py-3 inline-block font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">Edit</Link>
                    <button @click="destroy(user.id)" type="button" class="px-8 cursor-pointer py-3 inline-block font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">Delete</button>
                </li>
            </ul>
            </div>

            <div class="bg-gray-800 px-6 py-6 my-10 w-11/12 mx-auto rounded-md">
                <table class="w-full whitespace-no-wrap">
                  <thead>
                    <tr
                      class="font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-300 dark:bg-gray-800"
                    >
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

            <div class="bg-gray-800 px-6 py-6 my-10 w-11/12 mx-auto rounded-md">
                <table class="w-full whitespace-no-wrap">
                  <thead>
                    <tr
                      class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800"
                    >
                      <th class="px-4 py-3">Title</th>
                      <th class="px-4 py-3">Amount</th>
                      <th class="px-4 py-3">Year</th>
                      <th class="px-4 py-3 text-center">Action</th>
                      <th class="px-4 py-3">Date</th>
                    </tr>
                  </thead>
                  <tbody
                    class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800"
                  >
                    <tr v-for="transaction in receipts.data" :key="transaction.id" class="text-gray-700 dark:text-gray-400">
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

            <div class="bg-gray-800 px-6 py-6 my-10 w-11/12 mx-auto rounded-md">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                      <tr
                        class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800"
                      >
                        <th class="px-4 py-3">Room No.</th>
                        <th class="px-4 py-3">Year</th>
                        <th class="px-4 py-3 text-center">Action</th>
                        <th class="px-4 py-3">Date</th>
                      </tr>
                    </thead>
                    <tbody
                      class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800"
                    >
                      <tr v-for="legal in legals" :key="legal.id"  class="text-gray-700 dark:text-gray-400">
                        <td class="px-4 py-3">
                          <div class="flex items-center text-sm">
                            {{ legal.room_no }}
                          </div>
                        </td>
                        <td class="px-4 py-3 text-sm">
                          {{ legal.year }}
                        </td>
                        <td class="px-4 py-3 text-xs">
                          <div class="flex justify-center items-center">
                            <a
                              target="_blank"
                              class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100"
                              :href="'/storage/legal/' + legal.link"
                            >
                              View
                            </a>
                          </div>
                        </td>
                        <td class="px-4 py-3 text-sm">
                          {{ legal.created_at }}
                        </td>
                      </tr>
                    </tbody>
                </table>
            </div>
        </main>

    </UserDashboard>
</template> 