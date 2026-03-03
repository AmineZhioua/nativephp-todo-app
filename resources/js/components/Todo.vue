<script lang="ts" setup>
import { computed, ref } from 'vue';
import { TodoService } from '../services/todo.service';
import { useToast } from 'primevue';
import Swal from 'sweetalert2';

defineOptions({
    name: 'Todo'
});

const props = defineProps({
    todo: {
        type: Object,
        required: true,
        default: () => ({})
    }
});

const emits = defineEmits(["refetch-on-success"]);

const todoService = new TodoService();
const toast = useToast();
const isDeleting = ref(false);

const statusColor = computed(() => {
    switch (props.todo.status) {
        case 'completed': return 'text-emerald-500';
        case 'in_progress': return 'text-amber-500';
        default: return 'text-sky-500';
    }
});

const statusText = computed(() => {
    switch (props.todo.status) {
        case 'completed': return 'Completed';
        case 'in_progress': return 'In Progress';
        default: return 'Pending';
    }
});

const statusDot = computed(() => {
    switch (props.todo.status) {
        case 'completed': return 'bg-emerald-400';
        case 'in_progress': return 'bg-amber-400';
        default: return 'bg-sky-400';
    }
});

async function deleteTodo(id: number | string) {
    if (isDeleting.value) return;
    const res = await Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
    });
    if (res.isConfirmed) {
        isDeleting.value = true;
        try {
            const deleteResponse = await todoService.deleteTodo(`http://10.0.2.2:8000/api/todos/${props.todo.id}`);
            if (deleteResponse.status === 200) {
                emits('refetch-on-success');
                toast.add({ severity: "success", summary: "Success", detail: "Todo deleted successfully !", life: 3000 });
            }
        } catch (err: any) {
            console.error("Error:", err);
            toast.add({ severity: "error", summary: "Error", detail: "An error occurred. Try again later", life: 3000 });
        } finally {
            isDeleting.value = false;
        }
    }
}

function goToEdit() {
    window.location.href = `/todo/${props.todo.id}/edit`;
}
</script>

<template>
    <div class="todo-card">
        <!-- Left accent bar -->
        <div class="accent-bar" :class="statusDot"></div>

        <div class="todo-body">
            <!-- Content -->
            <div class="todo-content">
                <h3 class="todo-title">{{ todo.title }}</h3>
                <p class="todo-description">{{ todo.description }}</p>
                <div class="status-badge">
                    <span class="status-dot" :class="statusDot"></span>
                    <span :class="['status-text', statusColor]">{{ statusText }}</span>
                </div>
            </div>

            <!-- Actions -->
            <div class="todo-actions">
                <button @click="goToEdit" class="action-btn edit-btn" title="Edit">
                    <i class="fa-regular fa-pen-to-square"></i>
                </button>
                <button @click="deleteTodo(todo.id)" class="action-btn delete-btn" title="Delete">
                    <i class="fa-regular fa-trash-can"></i>
                </button>
            </div>
        </div>
    </div>
</template>