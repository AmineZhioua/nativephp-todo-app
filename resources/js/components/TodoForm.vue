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

    // DATA
    const toast = useToast();
    const todoService = new TodoService();

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
                window.location.href = '/';
                toast.add({
                    severity: "success",
                    summary: "Success",
                    detail: isEditMode.value ? "Todo updated successfully!" : "Todo created successfully!",
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
    <form class="form-wrapper">
        <!-- Title -->
        <div class="field-group">
            <label for="title" class="field-label">Title</label>
            <input
                type="text"
                id="title"
                name="title"
                placeholder="Do the laundry…"
                class="field-input"
                v-model="title"
            />
        </div>

        <!-- Description -->
        <div class="field-group">
            <label for="description" class="field-label">Description</label>
            <textarea
                id="description"
                name="description"
                rows="5"
                placeholder="I have to do the laundry every Sunday or Saturday night…"
                class="field-input field-textarea"
                v-model="description"
            ></textarea>
        </div>

        <!-- Status -->
        <div class="field-group">
            <label class="field-label">Status</label>
            <div class="status-options">
                <!-- Completed -->
                <label class="status-option" :class="{ active: status === 'completed', completed: status === 'completed' }">
                    <input type="radio" name="todo-status" value="completed" v-model="status" class="sr-only" />
                    <span class="status-option-dot bg-emerald-400"></span>
                    Completed
                </label>
                <!-- In Progress -->
                <label class="status-option" :class="{ active: status === 'in_progress', in_progress: status === 'in_progress' }">
                    <input type="radio" name="todo-status" value="in_progress" v-model="status" class="sr-only" />
                    <span class="status-option-dot bg-amber-400"></span>
                    In Progress
                </label>
                <!-- Pending -->
                <label class="status-option" :class="{ active: status === 'pending', pending: status === 'pending' }">
                    <input type="radio" name="todo-status" value="pending" v-model="status" class="sr-only" />
                    <span class="status-option-dot bg-sky-400"></span>
                    Pending
                </label>
            </div>
        </div>

        <!-- Submit -->
        <button
            type="button"
            @click="handleSubmit"
            class="submit-btn"
            :disabled="isSubmitting"
        >
            <span v-if="!isSubmitting" class="submit-content">
                <i :class="isEditMode ? 'fa-solid fa-pen-to-square' : 'fa-solid fa-plus'" class="submit-icon"></i>
                {{ isEditMode ? 'Update Todo' : 'Add Todo' }}
            </span>
            
            <span v-else class="submit-content">
                <svg class="spinner" viewBox="0 0 24 24" fill="none">
                    <circle class="spinner-track" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="3"/>
                    <path class="spinner-arc" d="M12 2a10 10 0 0 1 10 10" stroke="currentColor" stroke-width="3" stroke-linecap="round"/>
                </svg>
                Saving…
            </span>
        </button>
    </form>
    <Toast />
</template>