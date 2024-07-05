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
    <div class="p-4 flex space-x-2">
        <ApplicationLogo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-400" />
        <div class="flex-1">
            <p class="text-lg text-gray-800">{{ data.quantity }}</p>
            <div class="flex space-x-4">
                <span class="text-sm text-gray-800">De:</span>
                <span class="text-sm text-gray-800">{{ data.from_storage.owner_user.name }} - <span class="text-sm text-gray-400">{{ data.from_storage.name }}</span></span>
                <span class="text-sm text-gray-800">Para:</span>
                <span class="text-sm text-gray-800">{{ data.to_storage.owner_user.name }} - <span class="text-sm text-gray-400">{{ data.to_storage.name }}</span></span>
            </div>
            <div class="flex flex-row-reverse">
                <span class="text-sm text-gray-800">{{ data.creator_user.name }}</span>
                <small class="mr-2 text-sm text-gray-600">{{ dayjs(data.created_at).fromNow() }}</small>
            </div>
        </div>
    </div>
</template>