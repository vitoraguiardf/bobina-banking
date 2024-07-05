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
            <div class="flex flex-auto">
                <p class="text-lg text-gray-900 w-full">{{ data.name }}</p>
                <p :class="[
                    'text-2xl text-gray-900',
                    { 'text-red-600': data.to_transactions_sum_quantity < data.from_transactions_sum_quantity },
                    { 'text-green-600': data.to_transactions_sum_quantity > data.from_transactions_sum_quantity }
                ]">
                    {{ data.to_transactions_sum_quantity - data.from_transactions_sum_quantity }}
                </p>
            </div>
            <div class="flex flex-row gap-1">
                <span class="text-sm text-green-700">Depositado {{ data.to_transactions_sum_quantity??0 }}</span>
                <span class="text-sm text-gray-700">/</span>
                <span class="text-sm text-red-700">Retirado {{ data.from_transactions_sum_quantity??0 }}</span>
            </div>
            <div class="flex flex-row-reverse">
                <span class="text-sm text-gray-800">{{ data.creator_user.name }}</span>
                <small class="mr-2 text-sm text-gray-600">{{ dayjs(data.created_at).fromNow() }}</small>
            </div>
        </div>
    </div>
</template>