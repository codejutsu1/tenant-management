<script setup>
import { Head, Link } from '@inertiajs/inertia-vue3';
import Dashboard from '@/Layouts/SuperAdminDashboard.vue';
import { reactive } from 'vue';

const props = defineProps({
    users: Object,
    errors: Object,
});

const form = reactive({
  room_no: '',
});

</script>

<template>
    <Dashboard>
        <Head title="Select room to view" />
        <main class="h-full overflow-y-auto z-30">
          <div class="container px-6 mx-auto grid">
            <h2
              class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200"
            >
              Select a room number to view occupants. 
            </h2>

            <div>
            <div class="w-full overflow-hidden rounded-lg shadow-xs pb-10">
              <div class="w-full overflow-x-auto">
                <form>
                  <label class="block">
                        <span class="text-gray-400 pt-4 pb-2 block font-semibold">Room No</span>
                        <select id="room_no" class="block w-full mt-1 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" v-model="form.room_no" >
                            <option value="" selected="selected" disabled>~ Select Room No ~</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                        </select>
                        <p v-if="errors.room_no" class="text-sm text-red-500">{{ errors.room_no }}</p>
                    </label>

                    <div class="flex justify-end py-5">
                        <Link
                          :href="route('view.occupants', form.room_no)"
                          class="px-8 py-3 inline-block font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                        >
                          View Occupants
                        </Link>
                    </div>
                </form>
              </div>
            </div>
            </div>
          </div>
        </main>
       
    </Dashboard>
</template>