<script setup>
import { Head, Link } from '@inertiajs/inertia-vue3';
import UserDashboard from '@/Layouts/UserDashboard.vue';
import { Inertia } from '@inertiajs/inertia';
import { reactive } from 'vue';
import Notification from '@/Components/Notification.vue';

const props = defineProps({
  errors: Object
});

const form = reactive({
  description: '',
  amount: ''
});

function submit(){
  Inertia.post(route('demo.other.payment', form));
}

</script>

<template>
    <UserDashboard>
        <div v-if="$page.props.flash.message" class="absolute top-8 right-10 z-40">
            <Notification :message="$page.props.flash.message" />
        </div>

        <Head title="Payment" />

        <main class="h-full overflow-y-auto z-30">
          <div class="container px-6 mx-auto grid">
            <h2
              class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200"
            >
              Make Payment
            </h2>

            <div class="bg-gray-800 rounded-md py-8">
              <h1 class="font-semibold text-3xl text-center text-gray-400">Other Payment</h1>
            </div>

            <div>
                <p class="text-center py-10 text-xl font-semibold text-gray-300">2. PAY VIA ONLINE</p>
            </div>

            <div class="flex justify-center items-center w-1/2 bg-gray-800 rounded-md p-8 mx-auto mb-5">
                <form class="w-full">
                <div class="space-y-5 mt-4 text-gray-300">
                    <div class="flex justify-between items-center">
                        <span class="font-semibold text-lg">Name: </span>
                        <span>Nwoko James</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="font-semibold text-lg">Email: </span>
                        <span>nwokojames@james.com</span>
                    </div>
                    
                        <div>
                            <label class="block">
                              <span class="text-gray-400 pt-4 pb-2 block font-semibold">Description</span>
                              <input
                                  class="block w-full mt-1 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                                  placeholder="Pay for ...?"
                                  v-model="form.description"
                              />
                              <p v-if="errors.description" class="text-sm text-red-500">{{ errors.description }}</p>
                          </label>
                        </div>
                        <div>
                            <label class="block">
                              <span class="text-gray-400 pt-4 pb-2 block font-semibold">Amount</span>
                              <input
                                  class="block w-full mt-1 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                                  placeholder="Amount to pay"
                                  v-model="form.amount"
                             />
                              <p v-if="errors.amount" class="text-sm text-red-500">{{ errors.amount }}</p>
                          </label>
                        </div>

                    <div class="flex justify-center items-center">
                    <input 
                      type="button"  
                      class="inline-block border border-black px-8 py-2 mt-5 rounded-md" 
                      value="Pay"
                      @click="submit"
                    />
                    </div>
                </div>
                </form>
            </div>

          </div>
        </main>

    </UserDashboard>
</template>