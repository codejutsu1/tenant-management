<script setup>
import Payment from '@/Components/Pay.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import { Inertia } from '@inertiajs/inertia';
import { reactive, computed, onMounted } from 'vue';
import Notification from '@/Components/Notification.vue';
import { usePage } from '@inertiajs/inertia-vue3'

const props = defineProps({
  setting: String,
})

const form = reactive({
    email: 'codejutsu@protonmail.com',
    amount: '120000',
    currency: 'NGN',
    channels: ['card']
})

function submit() {
    Inertia.post(route('pay'), form);       
}

</script>

<template>
    <div v-if="$page.props.flash.message" class="absolute top-8 right-10 z-40">
        <Notification :message="$page.props.flash.message"/>
    </div>

    <Head />
    
    <Payment>
      <div>
        <p class="text-center py-10 text-xl font-semibold text-gray-300">2. PAY VIA ONLINE</p>
      </div>

      <div class="flex justify-center items-center w-full md:w-1/2 bg-gray-800 rounded-md p-8 mx-auto mb-5">
        <form class="w-full">
          <div class="text-gray-300">
            <h1 class="text-4xl text-center font-semibold">&#8358; {{ parseInt(setting) }}</h1>
            <div class="space-y-5 mt-4">
              <div class="flex justify-between items-center">
                <span class="font-semibold text-lg">Name: </span>
                <span>{{ $page.props.auth.user.name }}</span>
              </div>
              <div class="flex justify-between items-center">
                <span class="font-semibold text-lg">Email: </span>
                <span>{{ $page.props.auth.user.email }}</span>
              </div>
              <div class="flex justify-between items-center">
                <span class="font-semibold text-lg">Payment for: </span>
                <span>House/Lodge</span>
              </div>
            </div>

            <div class="flex justify-center items-center">
              <input 
                type="button" 
                onclick="return confirm('Do you want to accept this order?')"
                @click="submit" 
                class="inline-block border border-black px-8 py-2 mt-5 rounded-md" 
                value="Pay">
            </div>
          </div>
        </form>
      </div>
    </Payment>
</template>