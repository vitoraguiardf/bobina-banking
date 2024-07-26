<script setup>
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
defineProps({
    items: {
        required: true,
    }
})
</script>
<template>
    <Dropdown align="right" width="48">
        <template #trigger>
            <span class="inline-flex rounded-md">
                <button
                    type="button"
                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                    {{ $page.props.auth.user.name }}
                    <svg
                        class="ms-2 -me-0.5 h-4 w-4"
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20"
                        fill="currentColor">
                        <path
                            fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                </button>
            </span>
        </template>
        <template #content>
            <template v-for="item in items" :key="item.id">
                <DropdownLink v-if="item.hasAccess"
                    :href="item.route" 
                    :active="item.active">
                    {{ item.name }}
                </DropdownLink>
            </template>
            <DropdownLink :href="route('logout')" method="post" as="button">
                Log Out
            </DropdownLink>
        </template>
    </Dropdown>
</template>