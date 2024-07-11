<script setup>
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import dayjs from 'dayjs'
import relativeTime from 'dayjs/plugin/relativeTime'
dayjs.extend(relativeTime)
defineProps([
    'data'
])
const actions = [
    { code: 1, name: 'Sum' },
    { code: 0, name: 'None' },
    { code: -1, name: 'Subtract' },
]
function getActionName(code) {
    return actions.filter((v) => (v.code==code)).pop().name
}
</script>
<template>
    <div class="p-4 flex space-x-2">
        <ApplicationLogo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-400" />
        <div class="flex-1">
            <p class="text-lg text-gray-900 w-full">{{ data.name }}</p>
            <div class="flex flex-row-2 gap-2">
                <span class="text-sm text-gray-500 w-full">Origin action: {{ getActionName(data.origin) }}</span>
                <span class="text-sm text-gray-500 w-full">Destin action: {{ getActionName(data.destin) }}</span>
            </div>
            <p class="text-sm text-gray-400">{{ data.description }}</p>
            <div class="flex flex-row-reverse">
                <span class="text-sm text-gray-800">{{ data.creator_user.name }}</span>
                <small class="mr-2 text-sm text-gray-600">{{ dayjs(data.created_at).fromNow() }}</small>
            </div>
        </div>
    </div>
</template>