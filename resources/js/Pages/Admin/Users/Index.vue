<script setup>
import { Head, Link } from '@inertiajs/inertia-vue3';
import Dashboard from '@/Layouts/AdminDashboard.vue';
import Pagination from '@/Components/Pagination.vue';
import Notification from '@/Components/Notification.vue';
import { Inertia } from '@inertiajs/inertia';

const props = defineProps({
  users: Object,    
});

const destroy = (id) => {
  if(confirm('Are you sure?')){
    Inertia.delete(route('users.destroy', id));
  }

  return { destroy }
}

</script>

<template>
    <div v-if="$page.props.flash.message" class="absolute top-8 right-10 z-40">
        <Notification :message="$page.props.flash.message" />
    </div>

    <Dashboard>
        <Head title="Users" />
        <main class="h-full overflow-y-auto z-30">
          <div class="container px-6 mx-auto grid">
            <div class="flex justify-between items-center">
              <h2
                class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200"
              >
                Here is a list of active tenants. 
              </h2>

              <Link :href="route('users.create')" class="px-8 cursor-pointer py-3 inline-block font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                Add New Tenant
              </Link>
            </div>

            <div>
            <div class="w-full overflow-hidden rounded-lg shadow-xs pb-10">
              <div class="w-full overflow-x-auto">
                <table class="w-full whitespace-no-wrap">
                  <thead>
                    <tr
                      class="font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-300 dark:bg-gray-800"
                    >
                      <th class="px-4 py-3">Name</th>
                      <th class="px-4 py-3">Gender</th>
                      <th class="px-4 py-3">Lodge</th>
                      <th class="px-4 py-3">Status</th>
                      <th class="px-4 py-3">Room No</th>
                      <th class="px-4 py-3">Phone</th>
                      <th class="px-4 py-3">Action</th>
                      <th class="px-4 py-3">Rent Due</th>
                    </tr>
                  </thead>
                  <tbody
                    class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800"
                  >
                    <tr v-for="user in users.data" :key="user.id" class="text-gray-700 dark:text-gray-400">
                      <td class="px-4 py-3 text-sm">  
                        <Link :href="route('users.show', user.id)">
                          {{ user.name }}
                        </Link>
                      </td>
                      <td class="px-4 py-3 text-sm">
                        {{ user.gender }}
                      </td>
                      <td class="px-4 py-3 text-sm">
                        Gucci
                      </td>
                      <td class="px-4 py-3 text-sm font-semibold">
                        <div v-if="user.paid" class="flex justify-center px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                          Paid (Full)
                        </div>
                        <div v-else-if="user.paid == NULL" class="flex justify-center px-2 py-1 font-semibold leading-tight text-orange-700 bg-orange-100 rounded-full dark:text-white dark:bg-orange-600">
                          Paid (INST)
                        </div>
                        <div v-else class="flex justify-center px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-full dark:text-red-100 dark:bg-red-700">
                          Not Paid
                        </div>
                      </td>
                      <td class="px-4 py-3 text-sm">
                        {{ user.room_no }}
                      </td>
                      <td class="px-4 py-3 text-sm">
                        {{ user.phone }}
                      </td>
                      <td class="px-4 py-3">
                        <div class="flex items-center space-x-4 text-sm">
                          <Link
                            onclick="return confirm('Are you sure you want to renew payment?')"
                            class="flex items-center justify-between px-2 py-2 text-sm font-semibold leading-5 text-purple-600 rounded-lg dark:text-green-200 dark:bg-green-700 focus:outline-none focus:shadow-outline-gray"
                            aria-label="Edit"
                            :href="route('admin.renew.payment', user.id)"
                          >
                            Renew
                          </Link>
                        </div>
                      </td>
                      <td class="px-4 py-3 font-semibold text-gray-200">
                        {{ user.rent_due }}
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- pagination -->
              <div
                  class="flex justify-center items-center mt-6 px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-gray-50 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800"
              >
                  <Pagination :links="users.links" />
              </div>
            </div>
            </div>
          </div>
        </main>
       
    </Dashboard>
</template>