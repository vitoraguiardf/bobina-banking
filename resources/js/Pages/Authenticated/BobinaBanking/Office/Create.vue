<template>
    <Head title="Office - New" />
    <DashboardLayout>
        <div class="max-w-2xl mx-auto p-2 sm:px-6 lg:px-4">
            <h3>New Office</h3>
            <form @submit.prevent class="mt-2">
                <p class="text-sm text-gray-500 text-end">Campos com * são obrigatórios</p>
                
                <InputText v-model="form.name" fluid
                    placeholder="Name" input-id="name" />
                <InputFeedBack input-id="name" :errorText="form.errors.name"/>

                <InputText v-model="form.description" fluid
                    placeholder="Description" input-id="description" />
                <InputFeedBack input-id="description" :errorText="form.errors.description"/>

                <div class="flex flex-auto gap-2 mt-2">
                    <Button label="Save" icon="pi pi-check" severity="success" fluid
                        @click="form.post(route('bobina-banking.office.store'), { onSuccess: () => form.reset() })" />
                    <Button as="a" label="Cancel" icon="pi pi-x" severity="warn" fluid
                        @click="form.reset()" :href="route('bobina-banking.office.index')" />
                </div>
            </form>
        </div>
    </DashboardLayout>
</template>
<script setup>
import { useForm, Head } from '@inertiajs/vue3';
import DashboardLayout from '@/Layouts/Authenticated/BobinaBanking/Dashboard.vue';
import InputFeedBack from '@/Components/InputFeedBack.vue'
const form = useForm({
    name: null,
    description: null,
})
</script>