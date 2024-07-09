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
    <div class="gap-2 p-4">
        <div class="flex">
            <div class="flex-1">
                <div class="flex flex-row">
                    <div class="flex flex-col w-full">
                        <h4 class="text-lg text-gray-900">{{ data.type.name }}</h4>
                        <span class="text-gray-400">#{{ data.id }}</span>
                    </div>
                    <span class="text-4xl text-gray-800 content-center">{{ data.quantity }}</span>
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
        <div class="flex flex-row-reverse">
            <span class="text-sm text-gray-800">{{ data.creator_user.name }}</span>
            <small class="mr-2 text-sm text-gray-600">{{ dayjs(data.created_at).fromNow() }}</small>
        </div>
    </div>
</template>