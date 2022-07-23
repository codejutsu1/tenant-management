<script setup>
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import Dashboard from '@/Layouts/SuperAdminDashboard.vue';
import { Inertia } from '@inertiajs/inertia';
import Notification from '@/Components/Notification.vue';

const props = defineProps({
    errors: Object,
    route: String,
    role: String,
    user: Object,
})

const form = useForm({
    name: props.user.name,
    email: props.user.email,
    phone: props.user.phone,
    gender: props.user.gender,
    dob: props.user.dob,
    type: props.user.type,
    state: props.user.state,
    lga: props.user.lga,
    occupation: props.user.occupation,
    terms: false,
});

const submit = () => {
    form.put(route(props.route, {'id': props.user.id}));
};
</script>

<template>
 
        <main class="h-full overflow-y-auto z-30">
          <div class="container px-6 mx-auto grid">
            <h2
              class="mt-6 text-2xl font-semibold text-gray-700 dark:text-gray-200"
            >
              Update {{ props.role }}
            </h2>
            <div class="bg-gray-800 px-4 py-10 my-10">
                <form action="#">
                    <label class="block">
                        <span class="text-gray-400 pt-4 pb-2 block font-semibold">{{ props.role }}'s Fullname</span>
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
                            type="email"
                            v-model="form.email"
                        />
                        <p v-if="errors.email" class="text-sm text-red-500">{{ errors.email }}</p>
                    </label>

                    <label class="block">
                        <span class="text-gray-400 pt-4 pb-2 block font-semibold">Phone Number</span>
                        <input
                            class="block w-full mt-1 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                            type="tel"
                            v-model="form.phone"
                        />
                        <p v-if="errors.phone" class="text-sm text-red-500">{{ errors.phone }}</p>
                    </label>

                    <label class="block">
                        <span class="text-gray-400 pt-4 pb-2 block font-semibold">Gender</span>
                        <select id="gender" class="block w-full mt-1 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" v-model="form.gender"  required>
                            <option value="" selected="selected" disabled>~ Select ~</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                        <p v-if="errors.gender" class="text-sm text-red-500">{{ errors.gender }}</p>
                    </label>

                    <label class="block">
                        <span class="text-gray-400 pt-4 pb-2 block font-semibold">Date of Birth</span>
                        <input
                            class="block w-full mt-1 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                            type="date"
                            v-model="form.dob"
                        />
                        <p v-if="errors.dob" class="text-sm text-red-500">{{ errors.dob }}</p>
                    </label>

                    <label class="block">
                        <span class="text-gray-400 pt-4 pb-2 block font-semibold">Type</span>
                        <select id="type" class="block w-full mt-1 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" v-model="form.type"  required>
                            <option value="" selected="selected" disabled>~ Select ~</option>
                            <option value="self-con">Self Container</option>
                            <option value="two-rooms">Two Rooms</option>
                            <option value="three-rooms">Three Rooms</option>
                            <option value="shop">Shop</option>
                        </select>
                        <p v-if="errors.type" class="text-sm text-red-500">{{ errors.type }}</p>
                    </label>

                    <label class="block">
                        <span class="text-gray-400 pt-4 pb-2 block font-semibold">State</span>
                        <select id="state" class="block w-full mt-1 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" v-model="form.state" required>
                            <option value="" selected="selected" disabled>~ Select ~</option>
                            <option value="Abia">Abia</option>
                            <option value="Anambra">Anambra</option>
                            <option value="Ebonyi">Ebonyi</option>
                            <option value="Enugu">Enugu</option>
                            <option value="Imo">Imo</option>
                        </select>
                        <p v-if="errors.state" class="text-sm text-red-500">{{ errors.state }}</p>
                    </label>

                    <label class="block">
                        <span class="text-gray-400 pt-4 pb-2 block font-semibold">Local Government Area</span>
                        <select id="lga" class="block w-full mt-1 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" v-model="form.lga"  required>
                            <option value="" selected="selected" disabled>~ Select ~</option>
                            <option value="Aniri">Aniri</option>
                            <option value="Awgu">Awgu</option>
                            <option value="Owerri-west">Owerri-West</option>
                            <option value="Idemili-North">Idemili-North</option>
                            <option value="Mbaise">Mbaise</option>
                        </select>
                        <p v-if="errors.lga" class="text-sm text-red-500">{{ errors.lga }}</p>
                    </label>

                    <label class="block">
                        <span class="text-gray-400 pt-4 pb-2 block font-semibold">Occupation</span>
                        <select id="occupation" class="block w-full mt-1 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" v-model="form.occupation" required>
                            <option value="" selected="selected" disabled>~ Select ~</option>
                            <option value="civil servant">Civil Servant</option>
                            <option value="businessman">Businessman</option>
                            <option value="freelancer">Freelancer</option>
                            <option value="enterpreneur">Enterpreneur</option>
                            <option value="student">Student</option>
                        </select>
                        <p v-if="errors.occupation" class="text-sm text-red-500">{{ errors.occupation }}</p>
                    </label>

                    <div class="flex justify-end py-5">
                        <input 
                          type="button" 
                          :value="'Update ' +  props.role "
                          onclick="return confirm('Are you sure you want to register this user?')"
                          @click="submit"
                          class="px-8 py-3 inline-block font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                        >
                    </div>
                </form>
            </div>
          </div>          
        </main>
</template>
