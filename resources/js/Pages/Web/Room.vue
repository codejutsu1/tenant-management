<script setup>
import { Head, Link } from '@inertiajs/inertia-vue3';
import AppLayout from '@/Layouts/App.vue';

</script>
<template>
     <AppLayout>
          <Head title="Choose Room" />

          <main>
               <div class="w-5/6 mx-auto py-10">
                   <div class="h-[300px] mx-auto w-1/2 border-2 border-gray-200 bg-stone-300">

                   </div>
                   <div class="py-5 mx-auto w-1/2">
                        <h1 class="font-semibold text-xl text-center py-4">Room Specifications</h1>
                        <ul class="grid grid-cols-2 gap-6 text-center">
                            <li>A kitchen</li>
                            <li>One Toilet</li>
                            <li>One Bathroom</li>
                            <li>Air conditioned</li>
                            <li>A large WardRobe</li>
                        </ul>
                   </div>
                   <div class="flex justify-center mt-5">
                       <Link :href="route('house.payment')" class="text-center border px-8 py-4 rounded-md">
                           Choose Room
                       </Link>
                   </div>
               </div>
          </main>
     </AppLayout>
     
</template>