<script setup>
import Payment from '@/Components/Pay.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import { Inertia } from '@inertiajs/inertia';
import { reactive } from 'vue';
import Notification from '@/Components/Notification.vue';

const form = reactive({
    email: 'joshua@nwatu.com',
    amount: '12000000',
    currency: 'NGN',
    channels: ['card']
})

function submit() {
    Inertia.post(route('demo.pay'));       
}

</script>

<template>
    <div v-if="$page.props.flash.message" class="absolute top-8 right-10 z-40">
        <Notification :message="$page.props.flash.message" />
    </div>

    <Head />
    
    <Payment>
      <div>
        <p class="text-center py-10 text-xl font-semibold text-gray-300">2. PAY VIA ONLINE</p>
      </div>

      <div class="flex justify-center items-center w-1/2 bg-gray-800 rounded-md p-8 mx-auto mb-5">
        <form class="w-full">
          <div class="text-gray-300">
            <h1 class="text-4xl text-center font-semibold">&#8358; 120,000.00</h1>
            <div class="space-y-5 mt-4">
              <div class="flex justify-between items-center">
                <span class="font-semibold text-lg">Name: </span>
                <span>Nwoko James</span>
              </div>
              <div class="flex justify-between items-center">
                <span class="font-semibold text-lg">Email: </span>
                <span>nwokojames@james.com</span>
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