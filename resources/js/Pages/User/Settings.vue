<script setup>
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import Dashboard from '@/Layouts/UserDashboard.vue';
import { Inertia } from '@inertiajs/inertia';

const props = defineProps({
    errors: Object,
    user: Object,
});
const form = useForm({
  name: props.user.name, 
  email: props.user.email,
  password: '',
  password_confirmation: ''
});

const password = useForm({
  current_password: '',
  new_password: '',
  new_password_confirmation: ''
});

function submit() {
  Inertia.post(route('update.tenant.email'), form, {
    onFinish: () => form.reset('password', 'password_confirmation')
  });
}

function updatePassword() {
  Inertia.post(route('update.tenant.password'), password, {
    onFinish: () => password.reset('current_password', 'new_password', 'new_password_confirmation')
  });
}

</script>

<template>
    <Dashboard>

        <Head title="Settings" />

        <main class="h-full overflow-y-auto z-30">
          <div class="container px-6 mx-auto grid">
            <h2
              class="mt-6 text-2xl font-semibold text-gray-700 dark:text-gray-200"
            >
              Settings
            </h2>
            <div class="bg-gray-800 px-4 py-10 my-10">
              <h1 class="my-3 text-lg font-semibold text-gray-200">Change Email</h1>
                <form>
                  <label class="block">
                        <span class="text-gray-400 pt-4 pb-2 block font-semibold">Name</span>
                        <input
                            class="block w-full mt-1 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                            v-model="form.name"
                        />
                        <p v-if="errors.name" class="text-sm text-red-500">{{ errors.name }}</p>
                    </label>
                    <label class="block">
                        <span class="text-gray-400 pt-4 pb-2 block font-semibold">Email</span>
                        <input
                            class="block w-full mt-1 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                            v-model="form.email"
                        />
                        <p v-if="errors.email" class="text-sm text-red-500">{{ errors.email }}</p>
                    </label>

                    <label class="block">
                        <span class="text-gray-400 pt-4 pb-2 block font-semibold">Password</span>
                        <input
                            class="block w-full mt-1 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                            placeholder="Input your Password"
                            type="password"
                            v-model="form.password"
                        />
                        <p v-if="errors.password" class="text-sm text-red-500">{{ errors.password }}</p>
                    </label>

                    <label class="block">
                        <span class="text-gray-400 pt-4 pb-2 block font-semibold">Confirm Password</span>
                        <input
                            class="block w-full mt-1 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                            placeholder="Confirm Password"
                            type="password"
                            v-model="form.password_confirmation"
                        />
                        <p v-if="errors.password_confirmation" class="text-sm text-red-500">{{ errors.password_confirmation }}</p>
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

            <div class="bg-gray-800 px-4 py-10 my-10">
              <h1 class="my-3 text-lg font-semibold text-gray-200">Change Password</h1>
                <form>
                    <label class="block">
                        <span class="text-gray-400 pt-4 pb-2 block font-semibold">Current Password</span>
                        <input
                            class="block w-full mt-1 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                            v-model="password.current_password"
                            placeholder="Input current password"
                            type="password"
                        />
                        <p v-if="errors.current_password" class="text-sm text-red-500">{{ errors.current_password }}</p>
                    </label>

                    <label class="block">
                        <span class="text-gray-400 pt-4 pb-2 block font-semibold">New Password</span>
                        <input
                            class="block w-full mt-1 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                            placeholder="Input your new Password"
                            type="password"
                            v-model="password.new_password"
                        />
                        <p v-if="errors.new_password" class="text-sm text-red-500">{{ errors.new_password }}</p>
                    </label>

                    <label class="block">
                        <span class="text-gray-400 pt-4 pb-2 block font-semibold">Confirm New Password</span>
                        <input
                            class="block w-full mt-1 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                            placeholder="Confirm new Password"
                            type="password"
                            v-model="password.new_password_confirmation"
                        />
                        <p v-if="errors.new_password_confirmation" class="text-sm text-red-500">{{ errors.new_password_confirmation }}</p>
                    </label>

                    <div class="flex justify-end py-5">
                        <input 
                          @click="updatePassword"
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
