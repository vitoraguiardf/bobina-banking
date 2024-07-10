<script setup>
import InputFeedBack from '@/Components/InputFeedBack.vue'
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
import dayjs from 'dayjs'
import relativeTime from 'dayjs/plugin/relativeTime'
dayjs.extend(relativeTime)
const props = defineProps([
    'data'
])
const form = useForm({
    quantity: props.data.quantity,
    description: props.data.description,
})
const editing = ref(false)
const items = [
    {
        label: 'Update',
        icon: 'pi pi-refresh',
        command: () => {
            editing.value = true
        }
    },
];
</script>
<template>
    <div class="gap-2 p-4">
        <Dialog v-model:visible="editing" modal header="Edit Transaction" :style="{ width: '25rem' }">
            <form @submit.prevent class="mt-2">

                <InputNumber v-model="form.quantity" :min="1" fluid
                    placeholder="Quantidade*" input-id="quantity" />
                <InputFeedBack input-id="quantity" :errorText="form.errors.quantity"/>

                <InputText v-model="form.description" fluid
                    placeholder="Descrição" input-id="description" />
                <InputFeedBack input-id="description" :errorText="form.errors.description"/>

                <div class="flex flex-auto gap-2 mt-2">
                    <Button label="Atualizar" icon="pi pi-check" severity="success" fluid
                        @click="form.put(route('transaction.update', data.id), { onSuccess: () => editing = false })" />
                    <Button as="a" label="Cancelar" icon="pi pi-x" severity="warn" fluid
                        @click="form.reset()" :href="route('transaction.index')" />
                </div>
            </form>
        </Dialog>
        <div class="flex">
            <div class="flex-1">
                <div class="flex">
                    <h4 class="flex-grow text-xl text-gray-900">{{ data.quantity }} - {{ data.type.name }}</h4>
                    <SplitButton label="Opções" class="flex-none text-sm" dropdownIcon="pi pi-cog"
                        :model="items" severity="secondary" outlined />
                </div>
                <p class="text-lg text-gray-900 w-full">{{ data.name }}</p>
                <div class="flex flex-auto gap-1">
                    <Fieldset legend="Origem" v-if="data.from_storage" class="w-full">
                        <div class="text-sm flex flex-col">
                            <span class="text-red-700">{{ data.from_storage?.owner_user?.name }}</span>
                            <span class="text-red-600">{{ data.from_storage?.name }}</span>
                        </div>
                    </Fieldset>
                    <Fieldset legend="Destino" v-if="data.to_storage" class="w-full">
                        <div class="text-sm flex flex-col">
                            <span class="text-green-700">{{ data.to_storage?.owner_user?.name }}</span>
                            <span class="text-green-600">{{ data.to_storage?.name }}</span>
                        </div>
                    </Fieldset>
                </div>
            </div>
        </div>
        <p class="text-sm text-gray-400">Informações: {{ data.description }}</p>
        <div class="flex text-sm">
            <span class="flex-grow text-gray-400">#{{ data.id }}</span>
            <small class="flex-none text-gray-600">{{ dayjs(data.created_at).fromNow() }}</small>
            <small v-if="data.created_at != data.updated_at" class="flex-none text-gray-600"> &middot; edited</small>
            <span class="flex-none text-gray-800 ml-2">{{ data.creator_user.name }}</span>
        </div>
    </div>
</template>