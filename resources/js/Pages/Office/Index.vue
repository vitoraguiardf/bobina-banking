<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
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
<Head title="Offices" />
    <AuthenticatedLayout>
        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="flex">
                    <div class="flex-grow text-lg text-gray-800">
                        <InputText placeholder="Filter" v-model="filters.global.value"></InputText>
                        <Button v-if="filters.global.value!=null" type="button" icon="pi pi-filter-slash" label="Clear" outlined @click="clearFilter()" />
                    </div>
                    <div class="flex-row-reverse">
                        <Button as="a" label="Create new" :href="route('office.create')" link disabled />
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
                        <Column field="name" header="Office" sortable>
                            <template #body="slotProps">
                                <div class="flex flex-row">
                                    <div class="flex-grow">
                                        <span class="text-gray-800 mx-1">{{ slotProps.data.name }}</span>
                                        &middot;
                                        <span class="text-gray-800">{{ slotProps.data.email_verified_at }}</span>
                                        <small class="flex-none text-sm text-gray-600">{{ dayjs(slotProps.data.created_at).fromNow() }}</small>
                                        <small class="flex-none text-sm text-gray-600" v-if="slotProps.data.created_at != slotProps.data.updated_at"> &middot; edited</small>
                                    </div>
                                </div>
                            </template>
                        </Column>
                        <Column field="coils" header="Coils" sortable>
                            <template #body="slotProps">
                                <span>0.000</span>
                            </template>
                        </Column>
                    </DataTable>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>