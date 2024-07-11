<template>
    <Head title="Offices" />
    <AuthenticatedLayout>
        <div class="max-w-2xl mx-auto p-2 sm:px-6 lg:px-4">
            <h3>Offices</h3>
            <form @submit.prevent>
                <div class="flex-1">
                    <InputText v-model="form.name" placeholder="Nome do Escritório" class="flex-grow" />
                    <Button type="submit" label="Save" class="flex-none block"
                        @click="form.post(route('office.store'), { onSuccess: () => { form.reset() } })" />
                </div>
                <InputFeedBack input-id="description" :errorText="form.errors.name"/>
            </form>
            <div class="bg-white shadow-sm rounded-lg divide-y">
                <Office v-for="item in items" :key="item.id" :data="item" />
            </div>
        </div>
    </AuthenticatedLayout>
</template>
<script setup>
import { useForm, Head } from '@inertiajs/vue3'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import InputFeedBack from '@/Components/InputFeedBack.vue'
import Office from '@/Components/Office.vue'
defineProps([
    'items'
])
const form = useForm({
    name: null
})
</script>