<script setup>
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import AddNewUser from '@/Components/RegisterUser.vue';
import Dashboard from '@/Layouts/SuperAdminDashboard.vue';

const props = defineProps({
    errors: Object,
});


</script>

<template>
    <Dashboard>
        <Head title="Add New Caretaker" />
        
        <AddNewUser :errors="errors" :role="'Caretaker'" :route="'caretakers.store'" />

    </Dashboard>
</template>