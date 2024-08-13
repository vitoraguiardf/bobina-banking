<script setup>
defineProps({
    id: {
        type: String,
        required: false,
    },
    tag: {
        type: String,
        required: true,
    }
})
</script>
<template>
    <div :id="id" class="flex flex-row gap-2">
        <a :href="'#'+id"><i class="pi pi-link"></i></a>
        <h1 v-if="tag=='h1'||tag=='H1'||tag=='1'"><slot></slot></h1>
        <h2 v-else-if="tag=='h2'||tag=='H2'||tag=='2'"><slot></slot></h2>
        <h3 v-else-if="tag=='h3'||tag=='H3'||tag=='3'"><slot></slot></h3>
        <h4 v-else-if="tag=='h4'||tag=='H4'||tag=='4'"><slot></slot></h4>
        <h5 v-else-if="tag=='h5'||tag=='H5'||tag=='5'"><slot></slot></h5>
        <h6 v-else-if="tag=='h6'||tag=='H6'||tag=='6'"><slot></slot></h6>
    </div>
</template>