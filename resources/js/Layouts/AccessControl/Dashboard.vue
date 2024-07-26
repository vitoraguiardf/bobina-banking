<script setup>
import NavBar from '@/Components/Layout/Nav/Bar.vue';
import Heading from '@/Components/Layout/Page/Heading.vue';
const navOptions = {
    home: {
        name: 'Access Control',
        route: route('access-control.dashboard'),
        active: route().current('access-control.dashboard'),
        hasAccess: true,
    },
    navItems: [
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
            name: 'Home',
            route: route('dashboard'),
            active: route().current('dashboard'),
            hasAccess: !route().current('dashboard'),
        },
        {
            name: 'Access-Control',
            route: route('access-control.dashboard'),
            active: route().current('access-control.dashboard'),
            hasAccess: !route().current('access-control.dashboard'),
        },
        {
            name: 'Profile',
            route: route('profile.edit'),
            active: route().current('profile.edit'),
            hasAccess: !route().current('profile.edit'),
        },
    ]
};
</script>
<template>
    <div>
        <Toast />
        <ConfirmDialog />
        <div class="min-h-screen bg-red-100 dark:bg-red-900">

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
