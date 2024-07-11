<template>
    <Head title="Transactions Type" />
    <AuthenticatedLayout>
        <div class="max-w-2xl mx-auto p-2 sm:px-6 lg:px-4">
            <h3>Tipos de Transferências - Criando</h3>
            <form @submit.prevent class="mt-2">

                <InputText v-model="form.name" fluid
                    placeholder="Nome" input-id="name" />
                <InputFeedBack input-id="name" :errorText="form.errors.name"/>

                <InputText v-model="form.description" fluid
                    placeholder="Descrição" input-id="description" />
                <InputFeedBack input-id="description" :errorText="form.errors.description"/>

                <Panel header="Cálculo da Conta">
                    <div class="flex flex-auto gap-2">
                        <div class="flex-none">
                            <Fieldset legend="Origem" class="w-full">
                                <SelectButton v-model="form.origin" :options="actions" filter button-id="origin"
                                    optionLabel="name" optionValue="code" />
                            </Fieldset>
                            <InputFeedBack input-id="description" :errorText="form.errors.origin"/>
                        </div>
                        <div class="flex-none">
                            <Fieldset legend="Destino" class="w-full">
                                <SelectButton v-model="form.destin" :options="actions" filter button-id="destin"
                                    optionLabel="name" optionValue="code" />
                            </Fieldset>
                            <InputFeedBack input-id="description" :errorText="form.errors.destin"/>
                        </div>
                    </div>
                </Panel>

                <div class="flex flex-auto gap-2 mt-2">
                    <Button label="Inserir" icon="pi pi-check" severity="success" fluid
                        @click="form.post(route('transaction-types.store'), { onSuccess: () => form.reset() })" />
                    <Button as="a" label="Cancelar" icon="pi pi-x" severity="warn" fluid
                        @click="form.reset()" :href="route('transaction-types.index')" />
                </div>
            </form>
        </div>
    </AuthenticatedLayout>
</template>
<script setup>
import { useForm, Head } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputFeedBack from '@/Components/InputFeedBack.vue'
const form = useForm({
    name: null,
    description: null,
    origin: null,
    destin: null,
})
const actions = [
    { code: 1, name: 'Sum' },
    { code: 0, name: 'None' },
    { code: -1, name: 'Subtract' },
]
</script>