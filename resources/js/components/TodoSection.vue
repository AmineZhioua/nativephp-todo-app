<script lang="ts" setup>
import Todo from './Todo.vue';

    defineOptions({
        name: 'TodoSection'
    });
</script>

<template>
    <div class="flex flex-col gap-2">
        <Todo />
    </div>
</template>