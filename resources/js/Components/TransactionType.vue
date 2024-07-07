<script setup>
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import dayjs from 'dayjs'
import relativeTime from 'dayjs/plugin/relativeTime'
dayjs.extend(relativeTime)
defineProps([
    'data'
])
function getActionName(code) {
    if (code == true) {
        return " Somar"
    } else if (code == false) {
        return " Subtrair"
    } else if (code == null) {
        return " Nenhuma"
    }
}
</script>
<template>
    <div class="p-4 flex space-x-2">
        <ApplicationLogo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-400" />
        <div class="flex-1">
            <p class="text-lg text-gray-900 w-full">{{ data.name }}</p>
            <div class="flex flex-row-2 gap-2">
                <span class="text-sm text-gray-500 w-full">Ação na conta de origem: {{ getActionName(data.origin) }}</span>
                <span class="text-sm text-gray-500 w-full">Ação na conta de destino: {{ getActionName(data.destin) }}</span>
            </div>
            <p class="text-sm text-gray-400">{{ data.description }}</p>
            <div class="flex flex-row-reverse">
                <span class="text-sm text-gray-800">{{ data.creator_user.name }}</span>
                <small class="mr-2 text-sm text-gray-600">{{ dayjs(data.created_at).fromNow() }}</small>
            </div>
        </div>
    </div>
</template>