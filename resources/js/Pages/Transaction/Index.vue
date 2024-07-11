<template>
    <Head title="Transactions" />
    <AuthenticatedLayout>
        <div class="max-w-2xl mx-auto p-2 sm:px-6 lg:px-4">
            <h3>Transactions</h3>
            <div class="flex flex-row-reverse">
                <Button as="a" label="New" :href="route('transaction.create')" link />
            </div>            
            <div class="bg-white shadow-sm rounded-lg divide-y">
                <Transaction v-for="item in items" :key="item.id" :data="item" />
            </div>
        </div>
    </AuthenticatedLayout>
</template>
<script setup>
import { Head } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Transaction from '@/Components/Transaction.vue'
defineProps([
    'items'
])
</script>