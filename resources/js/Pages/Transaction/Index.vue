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

// Services
const form = useForm([]);
const confirm = useConfirm();
const toast = useToast();

// Methods
const destroyItem = (item) => {
    form.delete(route('transaction.destroy', item.id), {
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
<Head title="Transactions" />
    <AuthenticatedLayout>
        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="flex">
                    <div class="flex-grow text-lg text-gray-800">
                        <InputText placeholder="Filter" v-model="filters.global.value"></InputText>
                        <Button v-if="filters.global.value!=null&&filters.global.value!=''" type="button" icon="pi pi-filter-slash" label="Clear" outlined @click="clearFilter()" />
                    </div>
                    <div class="flex-row-reverse">
                        <Button as="a" label="Create new" :href="route('transaction.create')" link disabled />
                    </div> 
                </div>
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <ContextMenu ref="ctxMenu" :model="ctxModel" @hide="ctxItem=null" />
                    <DataTable :value="items" stripedRows removableSort sortMode="multiple"
                        contextMenu v-model:contextMenuSelection="ctxItem" @rowContextmenu="onRowContextMenu"
                        v-model:filters="filters">
                        <Column field="id" header="#" sortable />
                        <Column field="type.name" header="Transaction" sortable>
                            <template #body="data">
                                <div class="flex flex-col">
                                    <span class="text-gray-800 dark:text-gray-200">{{ data.data.type.name }}</span>
                                    <Created :data="{creator_user, create_at, updated_at} = data.data" />
                                </div>
                            </template>
                        </Column>
                        <Column field="from_storage.name" header="From" sortable>
                            <template #body="data">
                                <div class="flex flex-col">
                                    <template v-if="data.data.from_storage!=null">
                                        <span class="text-gray-800 dark:text-gray-200">{{ data.data.from_storage.name }}</span>
                                        <span class="flex-row text-sm text-gray-600 dark:text-gray-400">{{ data.data.from_storage.name }}</span>
                                    </template>
                                    <template v-else>
                                        <span class="text-gray-800 dark:text-gray-200">&middot;</span>
                                    </template>
                                </div>
                            </template>
                        </Column>
                        <Column field="to_storage.name" header="To" sortable>
                            <template #body="data">
                                <div class="flex flex-col">
                                    <template v-if="data.data.to_storage!=null">
                                        <span class="text-gray-800 dark:text-gray-200">{{ data.data.to_storage.name }}</span>
                                        <span class="flex-row text-sm text-gray-600 dark:text-gray-400">{{ data.data.to_storage.name }}</span>
                                    </template>
                                    <template v-else>
                                        <span class="text-gray-800 dark:text-gray-200">&middot;</span>
                                    </template>
                                </div>
                            </template>
                        </Column>
                        <Column field="quantity" header="Coils" sortable />
                    </DataTable>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>