<script setup>
import Dashboard from '@/Layouts/UserDashboard.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import Notification from '@/Components/Notification.vue';
import { Inertia } from '@inertiajs/inertia';
import { reactive } from 'vue';

const props = defineProps({
    errors: Object,
})

const form = reactive({
    room_no: '',
})

function submit(){
    Inertia.post(route('choose.a.room'), form)
}

</script>

<template>
    <div v-if="$page.props.flash.message" class="absolute top-8 right-10 z-40">
        <Notification :message="$page.props.flash.message" />
    </div>

    <Dashboard>
      <Head title="Choose Room" />

        <main class="h-full overflow-y-auto z-30">
          <div class="flex justify-center items-center mt-20 w-1/2 bg-gray-800 rounded-md p-8 mx-auto mb-5">
            <form class="w-full">
              <div class="text-gray-300">
                <div class="space-y-5 mt-4">
                  <div class="flex justify-between items-center">
                    <span class="font-semibold text-lg">Name: </span>
                    <span>{{ $page.props.auth.user.name }}</span>
                  </div>
                  <div class="flex justify-between items-center">
                    <span class="font-semibold text-lg">Email: </span>
                    <span>{{ $page.props.auth.user.email }}</span>
                  </div>
                  <form>
                    <label class="block mt-4">
                        <span class="text-gray-300 text-lg pt-4 pb-2 block font-semibold">Room Number</span>
                        <select v-model="form.room_no" id="gender" class="block w-full mt-1 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" required>
                            <option value="" selected="selected" disabled>~ Select ~</option>
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
                  </form>
                </div>

                <div class="flex justify-center items-center">
                  <input 
                    type="button" 
                    onclick="return confirm('Confirm you want to choose this room?')"
                    @click="submit" 
                    class="inline-block border border-black px-8 py-2 mt-5 rounded-md" 
                    value="Choose Room">
                </div>
              </div>
            </form>
          </div>
        </main>
    </Dashboard>
</template>