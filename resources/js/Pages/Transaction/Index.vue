<template>
    <Head title="Transactions" />
    <AuthenticatedLayout>
        <div class="max-w-2xl mx-auto p4 sm:p-6 lg:p-8">
            <form @submit.prevent="form.post(route('transaction.store'), { onSuccess: () => form.reset() })">
                <div class="flex space-x-2">
                    <input type="number" v-model="form.transaction_type_id" class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                    <input type="number" v-model="form.from_storage_id" class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                    <input type="number" v-model="form.to_storage_id" class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                    <input type="number" v-model="form.quantity" class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                    <PrimaryButton class="block">Save</PrimaryButton>
                </div>
            </form>
            <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
                <Transaction v-for="item in items" :key="item.id" :data="item" />
            </div>
        </div>
    </AuthenticatedLayout>
</template>
<script setup>
import { useForm, Head } from '@inertiajs/vue3'
import Transaction from '@/Components/Transaction.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
defineProps([
    'items'
])
const form = useForm({
    transaction_type_id: null,
    from_storage_id: null,
    to_storage_id: null,
    quantity: null,
})
</script>