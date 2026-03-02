<script lang="ts" setup>
import { computed } from 'vue';

    defineOptions({
        name: 'Todo'
    });

    // PROPS
    const props = defineProps({
        todo: {
            type: Object,
            required: true,
            default: () => ({})
        }
    });

    // Status color (cleaner UI)
    const statusColor = computed(() => {
        switch (props.todo.status) {
            case 'completed':
                return 'text-green-500';
            case 'in_progress':
                return 'text-yellow-500';
            default:
                return 'text-gray-500';
        }
    });

    // Navigate to edit page
    function goToEdit() {
        window.location.href = `/todo/${props.todo.id}/edit`;
    };
</script>

<template>
    <div class="bg-white p-3 rounded-xl shadow-md">

        <div class="flex justify-between items-start">

            <div>
                <h3 class="mb-2 font-semibold">{{ todo.title }}</h3>
                <p class="text-sm text-[#888]">{{ todo.description }}</p>

                <span class="flex items-center gap-2 text-sm text-[#888]">
                    Status:
                    <p :class="['font-bold', statusColor]">
                        {{ todo.status }}
                    </p>
                </span>
            </div>

            <!-- EDIT BUTTON -->
            <button
                @click="goToEdit"
                class="bg-black text-white text-sm px-3 py-1 rounded-lg"
            >
                Edit
            </button>

        </div>

    </div>
</template>