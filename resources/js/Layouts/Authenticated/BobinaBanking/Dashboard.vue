<script setup>
import NavBar from '@/Components/Layout/Nav/Bar.vue';
import Heading from '@/Components/Layout/Page/Heading.vue';
const navOptions = {
    home: {
        name: 'Dashboard',
        route: route('bobina-banking.dashboard'),
        active: route().current('bobina-banking.dashboard'),
        hasAccess: true,
    },
    navItems: [
        {
            name: 'Users',
            route: route('bobina-banking.users.index'),
            active: route().current('bobina-banking.users.index'),
            hasAccess: true,
        },
        {
            name: 'Offices',
            route: route('bobina-banking.office.index'),
            active: route().current('bobina-banking.office.index'),
            hasAccess: true,
        },
        {
            name: 'Storages',
            route: route('bobina-banking.coil-storage.index'),
            active: route().current('bobina-banking.coil-storage.index'),
            hasAccess: true,
        },
        {
            name: 'Transaction Types',
            route: route('bobina-banking.transaction-types.index'),
            active: route().current('bobina-banking.transaction-types.index'),
            hasAccess: true,
        },
        {
            name: 'Transactions',
            route: route('bobina-banking.transaction.index'),
            active: route().current('bobina-banking.transaction.index'),
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
            name: 'Home Bobinas',
            route: route('bobina-banking.dashboard'),
            active: route().current('bobina-banking.dashboard'),
            hasAccess: !route().current('bobina-banking.dashboard'),
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
