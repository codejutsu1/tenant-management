<script setup>
import { Link } from '@inertiajs/inertia-vue3';

    const props = defineProps({
        links : Array,
    });
</script>


<template>
    <div v-if="links.length > 3">
        <div class="flex flex-wrap -mb-1">
        <template v-for="(link, k) in links" :key="k">
            <div v-if="link.url === null"  class="mr-1 mb-1 px-4 py-3 text-sm leading-4 text-gray-400 border rounded" v-html="link.label" />
            <Link v-else class="mr-1 mb-1 px-4 py-3 text-sm leading-4 border rounded hover:bg-purple-600 focus:border-purple-600 focus:text-purple-600" :class="{ 'bg-purple-600 text-white': link.active }" :href="link.url" v-html="link.label" />
        </template>
        </div>
  </div> 
</template>