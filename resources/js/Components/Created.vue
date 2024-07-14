<script setup>
import relativeTime from 'dayjs/plugin/relativeTime';
import dayjs from 'dayjs';
dayjs.extend(relativeTime)
defineProps([
    'data'
])
</script>
<template>
    <div class="flex-row text-sm text-gray-600 dark:text-gray-400">
        <small class="flex-none" v-if="data.creator_user!=null">
            <span :title="`Creator`">{{ data.creator_user.name }}</span>
        </small>
        <small class="flex-none">
            &middot;
            <span :title="`Created at ${dayjs(data.created_at).fromNow()}`"
                >{{ dayjs(data.created_at).fromNow() }}</span>
        </small>
        <small class="flex-none" v-if="data.created_at != data.updated_at">
            &middot;
            <span :title="`Updated at ${dayjs(data.updated_at).fromNow()}`">edited</span>
        </small>
    </div>
</template>