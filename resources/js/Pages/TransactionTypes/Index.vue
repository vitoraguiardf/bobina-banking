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
        <div class="max-w-2xl mx-auto p4 sm:p-6 lg:p-8">
            <form @submit.prevent="form.post(route('transaction-types.store'), { onSuccess: () => form.reset() })">
                <div class="flex space-x-3">
                    <div>
                        <input type="text" v-model="form.name" class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" />
                        <InputError :message="form.errors.name" class="mt-2"></InputError>
                    </div>
                    <div>
                        <input type="text" v-model="form.description" class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" />
                        <InputError :message="form.errors.description" class="mt-2"></InputError>
                    </div>
                    <PrimaryButton class="block">Save</PrimaryButton>
                </div>
            </form>
            <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
                <TransactionType v-for="item in items" :key="item.id" :data="item"></TransactionType>
            </div>
        </div>
    </AuthenticatedLayout>
</template>