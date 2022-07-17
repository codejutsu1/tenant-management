<script setup>
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import Dashboard from '@/Layouts/UserDashboard.vue';
import { Inertia } from '@inertiajs/inertia';
import { reactive } from 'vue';

const props = defineProps({
    errors: Object,
    user: Object,
});

const form = reactive({
  occupation: props.user.occupation, 
  gender: props.user.gender,
  state: props.user.state,
  lga: props.user.lga
});

function submit() {
    Inertia.post(route('update.tenant'), form);
}


</script>

<template>
    <Dashboard>

        <Head title="Edit" />

        <main class="h-full overflow-y-auto z-30">
          <div class="container px-6 mx-auto grid">
            <h2
              class="mt-6 text-2xl font-semibold text-gray-700 dark:text-gray-200"
            >
              Edit Personal Details
            </h2>
            <div class="bg-gray-800 px-4 py-10 my-10">
              <h1 class="my-3 text-lg font-semibold text-gray-200">Change Personal Details</h1>
              <p class="font-semibold text-gray-500 text-sm">Change of name or Email will require your password. <Link :href="route('user.settings')" class="underline">Click here to access the page.</Link></p>
                <form>
                  <label class="block">
                        <span class="text-gray-400 pt-4 pb-2 block font-semibold">Gender</span>
                        <input
                            class="block w-full mt-1 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                            v-model="form.gender"
                        />
                        <p v-if="errors.gender" class="text-sm text-red-500">{{ errors.gender }}</p>
                    </label>
                    <label class="block">
                        <span class="text-gray-400 pt-4 pb-2 block font-semibold">Occupation</span>
                        <input
                            class="block w-full mt-1 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                            v-model="form.occupation"
                        />
                        <p v-if="errors.occupation" class="text-sm text-red-500">{{ errors.occupation }}</p>
                    </label>

                    <label class="block">
                        <span class="text-gray-400 pt-4 pb-2 block font-semibold">State</span>
                        <input
                            class="block w-full mt-1 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                            v-model="form.state"
                        />
                        <p v-if="errors.state" class="text-sm text-red-500">{{ errors.state }}</p>
                    </label>

                    <label class="block">
                        <span class="text-gray-400 pt-4 pb-2 block font-semibold">LGA</span>
                        <input
                            class="block w-full mt-1 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                            v-model="form.lga"
                        />
                        <p v-if="errors.lga" class="text-sm text-red-500">{{ errors.lga }}</p>
                    </label>

                    <div class="flex justify-end py-5">
                        <input 
                          onclick="return confirm('Are you sure you want to make the following changes')"
                          @click="submit"
                          type="button" 
                          value="Update"
                          class="px-8 py-3 inline-block font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                        >
                    </div>
                </form>
            </div>
          </div>
        </main>

    </Dashboard>
</template>

<style>
  main{
    display: block;
  }
</style>
