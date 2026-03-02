<script lang="ts" setup>
import { ref, onMounted } from 'vue';
import TodoForm from './TodoForm.vue';
import axios from 'axios';

    const props = defineProps({
        todoId: {
            type: Number,
            required: true
        }
    });

    const todo = ref(null);

    onMounted(async () => {
        const response = await axios.get(
            `http://10.0.2.2:8000/api/todos/${props.todoId}`
        );

        if (response.data.success) {
            todo.value = response.data.todo;
        }
    });
</script>

<template>
    <TodoForm 
        v-if="todo" 
        :todo="todo" 
    />
</template>