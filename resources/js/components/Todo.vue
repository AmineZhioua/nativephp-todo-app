<script lang="ts" setup>
    defineOptions({
        name: 'Todo'
    });
</script>

<template>
    <div class="bg-white p-3 rounded-xl shadow-md">
        <div>
            <h3 class="mb-2 font-semibold">The todo title in here</h3>
            <span class="flex items-center gap-2 text-sm text-[#888]">Status: 
                <p class="text-green-500 font-bold">Completed</p>
            </span>
        </div>
    </div>
</template>