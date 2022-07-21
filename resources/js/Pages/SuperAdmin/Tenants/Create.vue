<script setup>
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import AddNewUser from '@/Components/RegisterUser.vue';
import Dashboard from '@/Layouts/SuperAdminDashboard.vue';
import Notification from '@/Components/Notification.vue';

const props = defineProps({
    errors: Object,
});


</script>

<template>
    <div v-if="$page.props.flash.message" class="absolute top-8 right-10 z-40">
        <Notification :message="$page.props.flash.message" />
    </div>

    <Dashboard>
        <Head title="Add New User" />
        
        <AddNewUser :errors="errors" :route="'tenants.store'" />

    </Dashboard>
</template>