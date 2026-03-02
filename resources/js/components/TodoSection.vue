<script lang="ts" setup>
import { onMounted, ref } from 'vue';
import Todo from './Todo.vue';
import { TodoService } from '../services/todo.service';
import { useToast, Toast, ProgressSpinner } from 'primevue';

    defineOptions({
        name: 'TodoSection'
    });

    // SETUP
    const todoService = new TodoService();
    const toast = useToast();

    // DATA
    const isLoading = ref(false);
    const allTodos = ref([]);

    // ON MOUNTED
    onMounted(getAllTodos);

    // METHODS
    async function getAllTodos() {
        if(isLoading.value) return;

        isLoading.value = true;

        try {
            // Request
            const getResponse = await todoService.getTodos("http://10.0.2.2:8000/api/todos");

            if(getResponse.status === 200) {
                toast.add({
                    severity: "success",
                    summary: "Success",
                    detail: "Todos done",
                    life: 3000
                });

                allTodos.value = getResponse.data.todos;
            }
        } catch(err: any) {
            console.log("Error in get All Todos: ", err);

            error.value = err;
            toast.add({
                severity: "error",
                summary: "Error",
                detail: "An error occurred. Try again later",
                life: 3000
            });
        } finally {
            isLoading.value = false;
        } 
    };
</script>

<template>
    <div class="h-full">
        <!-- Loading State -->
        <div 
            v-if="isLoading"
            class="flex items-center justify-center h-full"
        >
            <ProgressSpinner style="width: 30px; height: 30px" strokeWidth="6" fill="transparent"
                animationDuration=".5s" aria-label="Custom ProgressSpinner" />
        </div>

        <!-- Todos Lost -->
        <div 
            v-else-if="allTodos.length > 0"
            class="flex flex-col gap-4"
        >
            <Todo 
                v-for="todo in allTodos"
                :key="todo.id"
                :todo="todo"
            />
        </div>

        <!-- Empty Todos Message -->
        <div 
            v-else
            class="flex flex-col items-center justify-center gap-2 text-center h-full"    
        >
            <i class="fa-solid fa-xmark-circle text-red-500 text-3xl"></i>
            <h1 class="text-xl text-red-500 font-semibold">
                No Todos
            </h1>
            <p class="text-sm text-[#888]">Start by creating a new Todo</p>
        </div>
        
        <Toast />
    </div>
</template>