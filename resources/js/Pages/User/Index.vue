<script setup>
import { Head } from '@inertiajs/vue3'
import User from '@/Components/User.vue'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
defineProps([
    'items'
])
</script>
<template>
    <Head title="Users" />
    <AuthenticatedLayout>
        <div class="max-w-2xl mx-auto p-2 sm:p-6 lg:p-8">
            <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
                <User v-for="item in items" :key="item.id" :data="item" />
            </div>
        </div>
    </AuthenticatedLayout>
</template>