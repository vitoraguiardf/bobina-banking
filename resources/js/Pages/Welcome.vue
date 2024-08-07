<script setup>
import { Head } from '@inertiajs/vue3';
import SiteHeader from '@/Site/Header.vue';
import SiteContent from '@/Site/Content.vue';
import SiteCustomer from '@/Site/Customer.vue';
import SiteFooter from '@/Site/Footer.vue';

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
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
    <Head title="Welcome" />
    <section>
        <div style="background-image: url('images/background.jpg');" class="fixed left-0 top-0 w-full h-screen">
            <SiteHeader :canLogin="canLogin" :canRegister="canRegister"></SiteHeader>
            <SiteFooter :phpVersion="phpVersion" :laravelVersion="laravelVersion"></SiteFooter>
        </div>
    </section>
</template>