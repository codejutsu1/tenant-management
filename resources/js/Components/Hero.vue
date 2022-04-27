<script setup>
    import { Link }  from '@inertiajs/inertia-vue3';
    defineProps(['title']);
</script>

<template>
    <div class="bg-general-hero bg-cover bg-no-repeat bg-center h-96 relative flex items-center">
        <div class="bg-black absolute inset-0 opacity-80 z-30"></div>
        <div class="w-1/2 mx-auto z-40">
                <h1 class="text-5xl text-center text-zinc-200 font-semibold">{{ title }}</h1>

                <hr class="my-5 p-6">

                <div class="flex justify-center text-xl text-zinc-200">
                    <Link class="mr-3 text-fuchsia-700" :href="route('home')">HOME </Link> / <span class="ml-3">{{ title }}</span>
                </div>
        </div>
    </div>
</template>