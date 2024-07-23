<script setup>
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
defineProps({
    items: {
        required: false
    }
})
</script>
<template>
    <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
        <div class="px-4">
            <div class="font-medium text-base text-gray-800 dark:text-gray-200">
                {{ $page.props.auth.user.name }}
            </div>
            <div class="font-medium text-sm text-gray-500">{{ $page.props.auth.user.email }}</div>
        </div>
        <div class="mt-3 space-y-1">
            <template v-for="item in items" :key="item.id">
                <ResponsiveNavLink v-if="item.hasAccess"
                    :href="item.route" 
                    :active="item.active">
                    {{ item.name }}
                </ResponsiveNavLink>
            </template>
            <ResponsiveNavLink :href="route('logout')" method="post" as="button">
                Log Out
            </ResponsiveNavLink>
        </div>
    </div>
</template>