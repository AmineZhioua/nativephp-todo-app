<script lang="ts" setup>
import { ref, onMounted, computed } from 'vue';
import { Toast, useToast } from 'primevue';
import { TodoService } from '../services/todo.service';

    defineOptions({
        name: "TodoForm"
    });

    // PROPS
    const props = defineProps({
        todo: {
            type: Object,
            required: false,
            default: null
        }
    });

    // SETUP
    const toast = useToast();
    const todoService = new TodoService();

    // DATA
    const title = ref("");
    const description = ref("");
    const status = ref("pending");

    const isSubmitting = ref(false);

    // COMPUTED
    const isEditMode = computed(() => !!props.todo);

    // ON MOUNTED
    onMounted(() => {
        if (props.todo) {
            title.value = props.todo.title;
            description.value = props.todo.description;
            status.value = props.todo.status;
        }
    });

    // METHODS
    async function handleSubmit() {
        if (isSubmitting.value) return;

        isSubmitting.value = true;

        try {
            let response;

            if (isEditMode.value) {
                response = await todoService.updateTodo(
                    `http://10.0.2.2:8000/api/todos/${props.todo.id}`,
                    {
                        title: title.value,
                        description: description.value,
                        status: status.value
                    }
                );
            } else {
                response = await todoService.createTodo(
                    "http://10.0.2.2:8000/api/todos",
                    {
                        title: title.value,
                        description: description.value,
                        status: status.value
                    }
                );
            }

            if (response.status === 200 || response.status === 201) {
                toast.add({
                    severity: "success",
                    summary: "Success",
                    detail: isEditMode.value
                        ? "Todo updated successfully!"
                        : "Todo created successfully!",
                    life: 3000
                });
            }

        } catch (err: any) {
            console.error("Error:", err);
            toast.add({
                severity: "error",
                summary: "Error",
                detail: "An error occurred. Try again later",
                life: 3000
            });
        } finally {
            isSubmitting.value = false;
        }
    };
</script>

<template>
    <form class="mt-2">
        <!-- Title -->
        <div class="flex flex-col gap-2">
            <label for="todo" class="px-2 font-semibold">Title :</label>
            <input 
                type="text" 
                id="title" 
                name="title" 
                placeholder="Do the laundry" 
                class="border p-2 rounded-2xl"
                v-model="title"
            />
        </div>

        <!-- Description -->
        <div class="flex flex-col gap-2 mt-4">
            <label for="todo" class="px-2 font-semibold">Description :</label>
            <textarea 
                type="text" 
                id="description" 
                name="description" 
                rows="5"
                placeholder="I have to do the laundry every Sunday or Saturday night..." 
                class="border p-2 rounded-2xl"
                v-model="description"
            ></textarea>
        </div>

        <!-- Status -->
        <div class="flex flex-col gap-2 my-4">
            <label for="todo-status" class="px-2 font-semibold">Status :</label>
            <div class="flex items-center justify-between">
                <!-- Completed Status -->
                <div class="flex items-center gap-2">
                    <input type="radio" id="todo-completed" name="todo-status" value="completed" v-model="status" />
                    <label for="todo-completed">Completed</label>
                </div>

                <!-- In Progress Status -->
                <div class="flex items-center gap-2">
                    <input type="radio" id="todo-in-progress" name="todo-status" value="in_progress" v-model="status" />
                    <label for="todo-in-progress">In Progress</label>
                </div>

                <!-- Pending Status -->
                <div class="flex items-center gap-2">
                    <input type="radio" id="todo-pending" name="todo-status" value="pending" v-model="status" />
                    <label for="todo-pending">Pending</label>
                </div>
            </div>
        </div>

        <!-- Submit Button -->
        <button 
            type="button"
            @click="handleSubmit"
            class="bg-black rounded-xl text-center w-full text-white p-2 mt-4"
        >
            <i class="fa-solid fa-plus mr-2"></i>
            <span class="font-semibold">
                {{ isEditMode ? 'Update Todo' : 'Add Todo' }}
            </span>
        </button>
    </form>

    <Toast />
</template>