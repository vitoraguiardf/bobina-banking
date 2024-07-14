<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Created from '@/Components/Created.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { FilterMatchMode } from '@primevue/core/api';
import { useConfirm } from 'primevue/useconfirm';
import { useToast } from 'primevue/usetoast'
import { ref } from 'vue';
defineProps([
    'items'
])

const actions = [
    { code: 1, name: 'Sum' },
    { code: 0, name: 'None' },
    { code: -1, name: 'Subtract' },
]
function getActionName (code) {
    return actions.filter((v) => (v.code==code)).pop().name
}

// Services
const form = useForm([]);
const confirm = useConfirm();
const toast = useToast();

// Methods
const destroyItem = (item) => {
    form.delete(route('transaction-types.destroy', item.id), {
        onSuccess: () => {
            toast.add({ severity: 'success', summary: `Deleted`, detail: 'Successful deleted!', life: 3000 });
        },
    })
}

// Confirm Dialogs
const confirmDestroy = (item) => {
    confirm.require({
        message: 'Are you sure you want to proceed?',
        header: `Delete #${item.id}?`,
        icon: 'pi pi-exclamation-triangle',
        rejectProps: {
            label: 'Cancel',
            severity: 'secondary',
            outlined: true
        },
        acceptProps: {
            label: 'Delete',
            severity: 'danger',
            outlined: true
        },
        accept: () => { destroyItem(item) },
    });
};

// Context-menu
const ctxMenu = ref();
const ctxItem = ref();
const ctxModel = ref([
    {label: 'Delete', icon: 'pi pi-fw pi-times', command: () => { confirmDestroy(ctxItem.value); }},
]);
const onRowContextMenu = (event) => {
    ctxMenu.value.show(event.originalEvent);
};

// Filters
const filters = ref()
const initFilters = () => {
    filters.value = {
        global: { value: null, matchMode: FilterMatchMode.CONTAINS }
    }
}
const clearFilter = () => {
    initFilters();
}
initFilters();
</script>
<template>
<Head title="Transaction Types" />
    <AuthenticatedLayout>
        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="flex">
                    <div class="flex-grow text-lg text-gray-800">
                        <InputText placeholder="Filter" v-model="filters.global.value"></InputText>
                        <Button v-if="filters.global.value!=null&&filters.global.value!=''" type="button" icon="pi pi-filter-slash" label="Clear" outlined @click="clearFilter()" />
                    </div>
                    <div class="flex-row-reverse">
                        <Button as="a" label="Create new" :href="route('transaction-types.create')" link disabled />
                    </div> 
                </div>
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <ContextMenu ref="ctxMenu" :model="ctxModel" @hide="ctxItem=null" />
                    <DataTable :value="items" stripedRows removableSort sortMode="multiple"
                        contextMenu v-model:contextMenuSelection="ctxItem" @rowContextmenu="onRowContextMenu"
                        v-model:filters="filters">
                        <Column field="id" header="#" sortable />
                        <Column field="name" header="Transaction Type" sortable>
                            <template #body="data">
                                <div class="flex flex-col">
                                    <span class="text-gray-800 dark:text-gray-200">
                                        {{ data.data.name }}
                                    </span>
                                    <small class="text-gray-600 dark:text-gray-400">
                                        {{ data.data.description }}
                                    </small>
                                    <Created :data="{creator_user, create_at, updated_at} = data.data" />
                                </div>
                            </template>
                        </Column>
                        <Column field="origin" header="Origin" sortable>
                            <template #body="data">
                                <span v-if="data.data.origin">{{ getActionName(data.data.origin) }}</span>
                            </template>
                        </Column>
                        <Column field="destin" header="Destin" sortable>
                            <template #body="data">
                                <span v-if="data.data.destin">{{ getActionName(data.data.destin) }}</span>
                            </template>
                        </Column>
                    </DataTable>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>