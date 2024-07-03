<template>
    <div :class="['mb-2', containerClass]">
        <small v-if="errorText!=null" :id="`${inputId}-error`" class="text-red-600 dark:text-red-400">{{ errorText }}</small>
        <small v-else v-show="helpText!=null" :id="`${inputId}-help`" class="text-gray-600 dark:text-gray-400">{{ helpText }}</small>
        <hr v-show="errorText!=null||helpText!=null">
   </div>
</template>
<script setup>

const props = defineProps({
    inputId: {
        type: String,
    },
    helpText: {
        type: String,
        default: null
    },
    errorText: {
        type: String,
        default: null,
    },
    containerClass: {
        type: String,
        default: null,
    },
})
</script>