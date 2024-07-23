<script setup>
import NavBar from '@/Components/Layout/Nav/Bar.vue';
import Heading from '@/Components/Layout/Page/Heading.vue';
const navOptions = {
    home: {
        name: 'Dashboard',
        route: route('access-control.dashboard'),
        active: route().current('access-control.dashboard'),
        hasAccess: true,
    },
    navItems: [
        {
            name: 'Dashboard',
            route: route('access-control.dashboard'),
            active: route().current('access-control.dashboard'),
            hasAccess: true,
        },
        {
            name: 'Users',
            route: route('access-control.users.index'),
            active: route().current('access-control.users.index'),
            hasAccess: true,
        },
        {
            name: 'Roles',
            route: route('access-control.roles.index'),
            active: route().current('access-control.roles.index'),
            hasAccess: true,
        },
        {
            name: 'Permissions',
            route: route('access-control.permissions.index'),
            active: route().current('access-control.permissions.index'),
            hasAccess: true,
        },
    ],
    profileItems: [
        {
            name: 'Access-Control',
            route: route('access-control.dashboard'),
            active: route().current('access-control.dashboard'),
            hasAccess: true,
        },
        {
            name: 'Profile',
            route: route('profile.edit'),
            active: route().current('profile.edit'),
            hasAccess: true,
        },
    ]
};
</script>
<template>
    <div>
        <Toast />
        <ConfirmDialog />
        <div class="min-h-screen bg-blue-100 dark:bg-blue-900">

            <!-- Navigation Bar -->
            <NavBar :options="navOptions" />

            <!-- Page Heading -->
            <Heading  v-if="$slots.header">
                <slot name="header" />
            </Heading>

            <!-- Page Content -->
            <main>
                <slot />
            </main>
        
        </div>
    </div>
</template>
