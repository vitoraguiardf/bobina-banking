<script setup>
import { useForm, Head } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import TransactionType from '@/Components/TransactionType.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
defineProps([
    'items'
])
const form = useForm({
    name: '',
    description: '',
})
</script>
<template>
    <Head title="Transaction Types" />
    <AuthenticatedLayout>
        <div class="max-w-2xl mx-auto p-2 sm:px-6 lg:px-4">
            <h3>Tipos de Transferência</h3>
            <div class="flex flex-row-reverse">
                <Button as="a" label="Nova" :href="route('transaction-types.create')" link />
            </div>            
            <div class="bg-white shadow-sm rounded-lg divide-y">
                <TransactionType v-for="item in items" :key="item.id" :data="item"></TransactionType>
            </div>
        </div>
    </AuthenticatedLayout>
</template>