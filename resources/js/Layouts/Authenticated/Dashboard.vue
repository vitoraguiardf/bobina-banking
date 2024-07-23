<script setup>
import NavBar from '@/Components/Layout/Nav/Bar.vue';
import Heading from '@/Components/Layout/Page/Heading.vue';
const navOptions = {
    home: {
        name: 'Dashboard',
        route: route('dashboard'),
        active: route().current('dashboard'),
        hasAccess: true,
    },
    navItems: [
        {
            name: 'Dashboard',
            route: route('dashboard'),
            active: route().current('dashboard'),
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
        <div class="min-h-screen bg-green-100 dark:bg-green-900">

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
