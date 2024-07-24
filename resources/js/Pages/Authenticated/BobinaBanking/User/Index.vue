<script setup>
import DashboardLayout from '@/Layouts/Authenticated/BobinaBanking/Dashboard.vue';
import Created from '@/Components/Created.vue';
import { Head } from '@inertiajs/vue3';
import relativeTime from 'dayjs/plugin/relativeTime';
import { FilterMatchMode } from '@primevue/core/api';
import { ref } from 'vue';
import dayjs from 'dayjs';
dayjs.extend(relativeTime)
defineProps([
    'items'
])

// Context-menu
const ctxMenu = ref();
const ctxItem = ref();
const ctxModel = ref([
    {label: 'Delete', icon: 'pi pi-fw pi-times', command: () => {}},
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
<Head title="Users" />
    <DashboardLayout>
        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="flex">
                    <div class="flex-grow text-lg text-gray-800">
                        <InputText placeholder="Filter" v-model="filters.global.value"></InputText>
                        <Button v-if="filters.global.value!=null" type="button" icon="pi pi-filter-slash" label="Clear" outlined @click="clearFilter()" />
                    </div>
                    <div class="flex-row-reverse">
                        <Button as="a" label="Create new" :href="route('bobina-banking.users.index')" link disabled />
                    </div> 
                </div>
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <ContextMenu ref="ctxMenu" :model="ctxModel" @hide="ctxItem=null" />
                    <DataTable :value="items" stripedRows removableSort sortMode="multiple"
                        contextMenu v-model:contextMenuSelection="ctxItem" @rowContextmenu="onRowContextMenu"
                        v-model:filters="filters">
                        <Column field="id" header="#" sortable>
                            <template #body="slotProps">
                                <pre>{{ slotProps.data.id }}</pre>
                            </template>
                        </Column>
                        <Column field="name" header="User" sortable>
                            <template #body="slotProps">
                                <div class="flex flex-col">
                                    <span class="text-gray-800 dark:text-gray-200">
                                        <span>{{ slotProps.data.name }}</span>
                                        &middot;
                                        <small class="text-sm text-gray-400 dark:text-gray-600">
                                            {{ slotProps.data.email }}
                                            <span v-if="slotProps.data.email_verified_at"
                                            :title="`Verified at ${dayjs(slotProps.data.email_verified_at)}`"
                                            class="text-green-600">
                                                &check;verified
                                            </span>
                                        </small>
                                    </span>
                                    <Created :data="{creator_user, create_at, updated_at} = slotProps.data" />
                                </div>
                            </template>
                        </Column>
                        <Column field="coil-storages" header="Coil Storages" sortable>
                            <template #body="slotProps">
                                <Listbox :options="slotProps.data.coil_storages" optionLabel="name" disabled/>
                            </template>
                        </Column>
                        <Column field="quantity" header="Coils" sortable>
                            <template #body="slotProps">
                                <span>{{ slotProps.data.to_transactions_sum_quantity - slotProps.data.from_transactions_sum_quantity }}</span>
                            </template>
                        </Column>
                    </DataTable>
                </div>
            </div>
        </div>
    </DashboardLayout>
</template>