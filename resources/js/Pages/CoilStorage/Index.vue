<script setup>
import { useForm, Head } from '@inertiajs/vue3'
import CoilStorage from '@/Components/CoilStorage.vue'
import InputError from '@/Components/InputError.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
defineProps([
    'items'
])
const form = useForm({
    name: '',
})
</script>
<template>
    <Head title="Coil Storage" />
    <AuthenticatedLayout>
        <div class="max-w-2xl mx-auto p4 sm:p-6 lg:p-8">
            <form @submit.prevent="form.post(route('coil-storage.store'), { onSuccess: () => form.reset() })">
                <div class="flex space-x-2">
                    <input type="text"
                        v-model="form.name"
                        placeholder="Como você gostaria de identificar este depósito?"
                        class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                    >
                    <PrimaryButton class="block">Save</PrimaryButton>
                </div>
                <InputError :message="form.errors.name" class="mt-2" />
            </form>
            <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
                <CoilStorage v-for="item in items" :key="item.id" :data="item" />
            </div>
        </div>
    </AuthenticatedLayout>
</template>