<script setup>
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import dayjs from 'dayjs'
import relativeTime from 'dayjs/plugin/relativeTime'
dayjs.extend(relativeTime)
defineProps([
    'data'
])
</script>
<template>
    <div class="p-4 flex space-x-3">
        <ApplicationLogo class="h-9 w-auto text-gray-800 dark:text-gray-400" />
        <div class="flex-1">
            <h4 class="text-lg text-gray-900 w-full">Transferência n°: {{ data.id }}</h4>
            <p class="text-lg text-gray-900 w-full">{{ data.name }}</p>
            <div class="flex flex-row-2 gap-1">
                <Fieldset legend="Origem" class="w-full">
                    <div class="text-sm text-gray-500 flex flex-col">
                        <span class="text-gray-700">{{ data.from_storage?.owner_user?.name }}</span>
                        <span class="text-gray-500">{{ data.from_storage?.name }}</span>
                    </div>
                </Fieldset>
                <Fieldset legend="Destino" class="w-full">
                    <div class="text-sm text-gray-500 flex flex-col">
                        <span class="text-gray-700">{{ data.to_storage?.owner_user?.name }}</span>
                        <span class="text-gray-500">{{ data.to_storage?.name }}</span>
                    </div>
                </Fieldset>
            </div>
            <p class="text-sm text-gray-400">Informações: {{ data.description }}</p>
            <div class="flex flex-row-reverse">
                <span class="text-sm text-gray-800">{{ data.creator_user.name }}</span>
                <small class="mr-2 text-sm text-gray-600">{{ dayjs(data.created_at).fromNow() }}</small>
            </div>
        </div>
        <p class="text-4xl text-gray-800 content-center">{{ data.quantity }}</p>
    </div>
</template>