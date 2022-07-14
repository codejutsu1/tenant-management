<script setup>
import { Link } from '@inertiajs/inertia-vue3';
</script>

<template>
    <Link class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
        <slot />
    </Link>
</template>
