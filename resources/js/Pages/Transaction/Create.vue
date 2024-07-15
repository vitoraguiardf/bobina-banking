<template>
    <Head title="Transactions - New" />
    <AuthenticatedLayout>
        <div class="max-w-2xl mx-auto p-2 sm:px-6 lg:px-4">
            <h3>Transactions - New</h3>
            <form @submit.prevent class="mt-2">
                <p class="text-sm text-gray-500 text-end">Campos com * são obrigatórios</p>

                <Select v-model="form.transaction_type_id" :options="type_items" fluid :disabled="loading"
                    placeholder="Tipo da Transação*" option-label="name" option-value="id" input-id="type" />
                <InputFeedBack input-id="type" :errorText="form.errors.transaction_type_id"/>
                
                <div v-if="form.transaction_type_id!=null" class="text-md text-gray-500">
                    <span>Description: {{ transaction_type.description }}</span>
                </div>

                <template v-if="form.transaction_type_id">
                    <Select v-model="form.from_storage_id" :options="computed_list_from" fluid
                        :disabled="transaction_type.origin==0||loading"
                        placeholder="Conta de Saída" option-label="name" option-value="id" input-id="from" />
                    <InputFeedBack input-id="from" :errorText="form.errors.from_storage_id"/>

                    <Select v-model="form.to_storage_id" :options="computed_list_to" fluid
                        :disabled="transaction_type.destin==0||loading"
                        placeholder="Conta Destino" option-label="name" option-value="id" input-id="to" />
                    <InputFeedBack input-id="to" :errorText="form.errors.to_storage_id"/>
                </template>

                <InputNumber v-model="form.quantity" :min="1" fluid :disabled="loading"
                    placeholder="Quantidade*" input-id="quantity" />
                <InputFeedBack input-id="quantity" :errorText="form.errors.quantity"/>

                <InputText v-model="form.description" fluid :disabled="loading"
                    placeholder="Descrição" input-id="description" />
                <InputFeedBack input-id="description" :errorText="form.errors.description"/>

                <div class="flex flex-auto gap-2 mt-2">
                    <Button label="Transferir" icon="pi pi-check" severity="success" fluid :loading ="loading"
                        @click="loading=true;form.post(route('transaction.store'), { onSuccess: () => form.reset(), onFinish: () => { loading=false; } });" />
                    <Button as="a" label="Cancelar" icon="pi pi-x" severity="warn" fluid v-show="!loading"
                        @click="form.reset()" :href="route('transaction.index')" />
                </div>
            </form>
        </div>
    </AuthenticatedLayout>
</template>
<script setup>
import { ref, computed } from 'vue';
import { useForm, Head } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputFeedBack from '@/Components/InputFeedBack.vue'
const form = useForm({
    transaction_type_id: null,
    from_storage_id: null,
    to_storage_id: null,
    description: null,
    quantity: null,
})
const loading = ref(false)
const computed_list_from = computed(() => {
    return props.from_items.map((i)=>({id: i.id, name: `${i.holder.name} - ${i.name}`}))
})
const computed_list_to = computed(() => {
    return props.to_items.map((i)=>({id: i.id, name: `${i.holder.name} - ${i.name}`}))
})
const transaction_type = computed(() => {
    return props.type_items.filter((v) => (v.id===form.transaction_type_id))[0]
})
const props = defineProps([
    'type_items',
    'from_items',
    'to_items',
])
</script>