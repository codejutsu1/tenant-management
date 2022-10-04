<script setup>
import Dashboard from '@/Layouts/SuperAdminDashboard.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import { Inertia } from '@inertiajs/inertia';
import { reactive } from 'vue';

const props = defineProps({
  errors: Object,
  users: Object,
  id: String,
  room_numbers: Number,
})

const form = reactive({
    room_no : props.id,
})

function submit(){
    Inertia.post(route('change.room.number', {'id': props.id}), form)
}
</script>

<template>
    <Dashboard>
        <Head />
        <main class="h-full overflow-y-auto z-30">
            <div class="flex justify-center items-center w-1/2 bg-gray-800 rounded-md p-8 mx-auto my-32">
                <form class="w-full">
                    <div class="text-gray-300">
                        <div class="space-y-4">
                            <p v-for="user in users" :key="user.id" class="font-semibold">
                                {{ user.name }}
                            </p>
                        </div>
                        <form>
                            <label class="block">
                                <span class="text-gray-400 pt-4 pb-2 block font-semibold">Room No</span>
                                <select id="room_no" class="block w-full mt-1 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" v-model="form.room_no" >
                                    <option value="" selected="selected" disabled>~ Select Room No ~</option>
                                    <option v-for="index in parseInt(room_numbers)" :key="index" :value="index">{{ index }}</option>
                                </select>
                                <p v-if="errors.room_no" class="text-sm text-red-500">{{ errors.room_no }}</p>
                            </label>
                        </form>

                        <div class="flex justify-center items-center">
                        <input 
                            type="button" 
                            onclick="return confirm('Do you want to proceed?')"
                            @click="submit" 
                            class="inline-block border border-black px-8 py-2 mt-5 rounded-md" 
                            value="Change">
                        </div>
                    </div>
                </form>
            </div>
        </main>    
    </Dashboard>

</template>