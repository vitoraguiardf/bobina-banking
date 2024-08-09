<script setup>
defineProps({
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
});
</script>
<template>
    <footer class="snap-end">
        <div class="relative left-0 bottom-0 w-full">
            <div class="text-lg font-medium text-center text-gray-500">
                Laravel v{{ laravelVersion }} (PHP v{{ phpVersion }})
            </div>
        </div>
    </footer>
</template>