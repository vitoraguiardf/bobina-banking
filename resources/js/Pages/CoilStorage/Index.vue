<template>
    <Head title="Coil Storage" />
    <AuthenticatedLayout>
        <div class="max-w-2xl mx-auto p-2 sm:px-6 lg:px-4">
            <h3>Coil Storages</h3>
            <div class="flex flex-row-reverse">
                <Button as="a" label="New" :href="route('coil-storage.create')" link />
            </div>            
            <div class="bg-white shadow-sm rounded-lg divide-y">
                <CoilStorage v-for="item in items" :key="item.id" :data="item" />
            </div>
        </div>
    </AuthenticatedLayout>
</template>
<script setup>
import { Head } from '@inertiajs/vue3'
import CoilStorage from '@/Components/CoilStorage.vue'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
defineProps([
    'items'
])
</script>