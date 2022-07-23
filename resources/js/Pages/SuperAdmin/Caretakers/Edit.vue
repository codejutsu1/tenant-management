<script setup>
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import Updateuser from '@/Components/Updateuser.vue';
import Dashboard from '@/Layouts/SuperAdminDashboard.vue';
import Notification from '@/Components/Notification.vue';

const props = defineProps({
    errors: Object,
    user: Object,
});


</script>

<template>
    <div v-if="$page.props.flash.message" class="absolute top-8 right-10 z-40">
        <Notification :message="$page.props.flash.message" />
    </div>

    <Dashboard>
        <Head title="Edit Tenant" />
        
        <Updateuser :errors="errors" :user="user" :role="'Caretaker'" :route="'caretakers.update'" />

    </Dashboard>
</template>