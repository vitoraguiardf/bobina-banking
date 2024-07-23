<script setup>
import NavLink from '@/Components/NavLink.vue';
defineProps({
    items: {
        required: true,
    }
})
</script>
<template>
    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
        <template v-for="item in items" :key="item.id">
            <NavLink v-if="item.hasAccess"
                :href="item.route"
                :active="item.active">
                {{ item.name }}
            </NavLink>
        </template>
    </div>
</template>
