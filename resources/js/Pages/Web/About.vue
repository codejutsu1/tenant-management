<script setup>
import { Head, Link } from '@inertiajs/inertia-vue3';
import AppLayout from '@/Layouts/App.vue';
import HeroLayout from '@/Components/Hero.vue';

</script>
<template>
     <AppLayout>
          <Head title="About Us" />

          <main>
               <HeroLayout title="About Us"/>
          </main>
     </AppLayout>
     
</template>