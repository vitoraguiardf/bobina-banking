<template>
    <Head title="Roles - New" />
    <DashboardLayout>
        <div class="max-w-2xl mx-auto p-2 sm:px-6 lg:px-4">
            <h3>New Role</h3>
            <form @submit.prevent class="mt-2">
                <p class="text-sm text-gray-500 text-end">Campos com * são obrigatórios</p>
               
                <InputText v-model="form.name" fluid :disabled="loading"
                    placeholder="Role Name" input-id="name" />
                <InputFeedBack input-id="name" :errorText="form.errors.name" />

                <div class="flex flex-auto gap-2 mt-2">
                    <Button label="Save" icon="pi pi-check" severity="success" fluid :loading ="loading"
                        @click="loading=true;form.post(route('access-control.roles.store'), { onSuccess: () => form.reset(), onFinish: () => { loading=false; } });" />
                    <Button as="a" label="Cancel" icon="pi pi-x" severity="warn" fluid v-show="!loading"
                        @click="form.reset()" :href="route('access-control.roles.index')" />
                </div>
            </form>
        </div>
    </DashboardLayout>
</template>
<script setup>
import { ref } from 'vue';
import { useForm, Head } from '@inertiajs/vue3';
import DashboardLayout from '@/Layouts/AccessControl/Dashboard.vue';
import InputFeedBack from '@/Components/InputFeedBack.vue'
const loading = ref(false)
const form = useForm({
    name: null,
})
</script>