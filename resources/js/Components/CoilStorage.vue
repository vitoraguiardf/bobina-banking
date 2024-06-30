<script setup>
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import dayjs from 'dayjs'
import relativeTime from 'dayjs/plugin/relativeTime'
dayjs.extend(relativeTime)
defineProps([
    'coilStorage'
])
</script>
<template>
    <div class="p-4 flex space-x-2">
        <ApplicationLogo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-400" />
        <div class="flex-1">
            <p class="text-lg text-gray-900">{{  coilStorage.name }}</p>
            <div class="flex flex-row-reverse">
                <span class="text-sm text-gray-800">{{  coilStorage.user.name }}</span>
                <small class="mr-2 text-sm text-gray-600">{{ dayjs(coilStorage.created_at).fromNow() }}</small>
            </div>
        </div>
    </div>
</template>