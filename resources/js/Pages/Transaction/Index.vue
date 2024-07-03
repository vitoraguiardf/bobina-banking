<template>
    <Head title="Transactions" />
    <AuthenticatedLayout>
        <div class="max-w-2xl mx-auto p-2 sm:px-6 lg:px-4">
            <h3>Transferências - Extrato</h3>
            <div class="flex flex-row-reverse">
                <Button as="a" label="Nova Transferência" :href="route('transaction.create')" link />
            </div>
            <div class="bg-white shadow-sm rounded-lg divide-y">
                <Transaction v-for="item in items" :key="item.id" :data="item" />
            </div>
        </div>
    </AuthenticatedLayout>
</template>
<script setup>
import { useForm, Head } from '@inertiajs/vue3'
import Transaction from '@/Components/Transaction.vue'
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