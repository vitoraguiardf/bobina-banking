<template>
    <Head title="Coil Storage - New" />
    <DashboardLayout>
        <div class="max-w-2xl mx-auto p-2 sm:px-6 lg:px-4">
            <h3>New Coil Storage</h3>
            <form @submit.prevent class="mt-2">
                <p class="text-sm text-gray-500 text-end">Campos com * são obrigatórios</p>
                
                <InputText v-model="form.name" fluid
                    placeholder="Name" input-id="name" />
                <InputFeedBack input-id="name" :errorText="form.errors.name"/>

                <InputText v-model="form.description" fluid
                    placeholder="Description" input-id="description" />
                <InputFeedBack input-id="description" :errorText="form.errors.description"/>

                <small class="text-sm text-gray-600">Assign storage to</small>
                <div class="flex flex-wrap justify-center gap-4">
                    <SelectButton @change="form.holder_id=null"
                        v-model="form.holder_type" :options="holder_type_options"
                        option-label="name" option-value="id" />
                </div>
                <Select v-if="form.holder_type" v-model="form.holder_id" fluid
                    :options="holder_options" :placeholder="`Select a holder`"
                    option-label="name" option-value="id" input-id="holder_id" />
                <InputFeedBack input-id="holder_id" :errorText="form.errors.holder_id"/>

                <div class="flex flex-auto gap-2 mt-2">
                    <Button label="Save" icon="pi pi-check" severity="success" fluid
                        @click="form.post(route('bobina-banking.coil-storage.store'), { onSuccess: () => form.reset() })" />
                    <Button as="a" label="Cancel" icon="pi pi-x" severity="warn" fluid
                        @click="form.reset()" :href="route('bobina-banking.coil-storage.index')" />
                </div>
            </form>
        </div>
    </DashboardLayout>
</template>
<script setup>
import { computed } from 'vue';
import { useForm, Head } from '@inertiajs/vue3';
import DashboardLayout from '@/Layouts/Authenticated/BobinaBanking/Dashboard.vue';
import InputFeedBack from '@/Components/InputFeedBack.vue'
const holder_type_options = computed(() => {
    return props.holder_types.map((value) => ({ id: value, name: value.split('\\').pop() }))
})
const holder_options = computed(() => {
    return props.holder_items[form.holder_type]
})
const form = useForm({
    holder_type: null,
    holder_id: null,
    name: null,
    description: null,
})
const props = defineProps([
    'holder_types',
    'holder_items',
])
</script>