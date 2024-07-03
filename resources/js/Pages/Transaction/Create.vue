<template>
    <Head title="Transactions" />
    <AuthenticatedLayout>
        <div class="max-w-2xl mx-auto p4 sm:p-6 lg:p-8">
            <form @submit.prevent>

                <Select v-model="form.transaction_type_id" :options="transcationTypes" fluid
                    placeholder="Tipo da Transação" option-label="name" option-value="id" input-id="type" />
                <InputFeedBack input-id="type" :errorText="form.errors.transaction_type_id"/>
                
                <Select v-model="form.from_storage_id" :options="fromAccounts" fluid
                    placeholder="Conta de Saída" option-label="name" option-value="id" input-id="from" />
                <InputFeedBack input-id="from" :errorText="form.errors.from_storage_id"/>

                <Select v-model="form.to_storage_id" :options="toAccounts" fluid
                    placeholder="Conta Destino" option-label="name" option-value="id" input-id="to" />
                <InputFeedBack input-id="to" :errorText="form.errors.to_storage_id"/>

                <InputNumber v-model="form.quantity" :min="0" :max="90" fluid
                    placeholder="Quantidade" input-id="quantity" />
                <InputFeedBack input-id="quantity" :errorText="form.errors.quantity"/>

                <div class="flex flex-auto gap-2 mt-2">
                    <Button label="Transferir" icon="pi pi-check" severity="success" fluid
                        @click="form.post(route('transaction.store'), { onSuccess: () => form.reset() })" />
                    <Button as="a" label="Cancelar" icon="pi pi-x" severity="warn" fluid
                        @click="form.reset()" :href="route('transaction.index')" />
                </div>
            </form>
        </div>
    </AuthenticatedLayout>
</template>
<script setup>
import { ref } from 'vue';
import { useForm, Head } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputFeedBack from '@/Components/InputFeedBack.vue'
const form = useForm({
    transaction_type_id: null,
    from_storage_id: null,
    to_storage_id: null,
    quantity: null,
})
// TODO: Get data from api
const transcationTypes = ref([
    { name: 'Type 1', id: 1 },
    { name: 'Type 2', id: 2 },
]);
// TODO: Get data from api
const fromAccounts = ref([
    { name: 'Origin 1', id: 1 },
    { name: 'Origin 2', id: 2 },
    { name: 'Origin 3', id: 3 },
]);
// TODO: Get data from api
const toAccounts = ref([
    { name: 'Destin 1', id: 1 },
    { name: 'Destin 2', id: 2 },
    { name: 'Destin 3', id: 3 },
]);

</script>