<script setup>
import { useForm, Head } from '@inertiajs/vue3'
import CoilStorage from '@/Components/CoilStorage.vue'
import InputFeedBack from '@/Components/InputFeedBack.vue'
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
        <div class="max-w-2xl mx-auto p-2 sm:p-6 lg:p-8">
            <form @submit.prevent="form.post(route('coil-storage.store'), { onSuccess: () => form.reset() })">
                <div class="flex">
                    <InputText v-model="form.name" fluid input-id="description" class="flex-grow"
                        placeholder="Como você gostaria de identificar este depósito?" />
                    <Button type="submit" label="Save" class="flex-none block" />
                </div>
                <InputFeedBack input-id="description" :errorText="form.errors.name"/>
            </form>
            <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
                <CoilStorage v-for="item in items" :key="item.id" :data="item" />
            </div>
        </div>
    </AuthenticatedLayout>
</template>