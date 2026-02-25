<script lang="ts" setup>
import axios from 'axios';
import { ProgressSpinner } from 'primevue';
import { onMounted, ref } from 'vue';

    defineOptions({
        name: "TestComp"
    });

    // DATA
    const isLoading = ref(false);
    const data = ref(null);

    // ON MOUNTED
    onMounted(fetchData);

    // METHODS
    async function fetchData() {
        if(isLoading.value) return;

        isLoading.value = true;

        // Request
        const fetchResponse = await axios.get("https://jsonplaceholder.typicode.com/todos", {
            headers: {
                "Content-Type": "application/json"
            }
        });

        if(fetchResponse.status === 200) {
            data.value = fetchResponse.data
        }

        isLoading.value = false;
    };
</script>

<template>
    <div v-if="isLoading">
        <ProgressSpinner style="width: 50px; height: 50px" strokeWidth="8" fill="transparent"
            animationDuration=".5s" aria-label="Custom ProgressSpinner" />
    </div>

    <div v-else>
        <div v-for="item in data">
            <h1>{{ item.title }}</h1>
            <span>{{ item.completed }}</span>
            <hr>
        </div>
    </div>
</template>