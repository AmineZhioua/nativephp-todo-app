<script lang="ts" setup>
    defineOptions({
        name: "LoginForm"
    });
</script>

<template>
    <form class="flex flex-col gap-4 w-full px-4">
        <div class="flex flex-col gap-2">
            <label for="email">Email:</label>
            <input 
                type="email" 
                id="email" 
                name="email" 
                placeholder="Your Email"
                class="border p-2 rounded-2xl"
            />
        </div>

        <div class="flex flex-col gap-2">
            <label for="password">Password:</label>
            <input 
                type="password" 
                id="password" 
                name="password" 
                placeholder="Your Password"
                class="border p-2 rounded-2xl"
            />
        </div>

        <button 
            type="button"
            class="bg-black text-white p-2 rounded-xl mt-2"
        >
            <span class="font-semibold">Sign in</span>
        </button>
    </form>
    
    <span class="text-sm">
        New here ? 
        <a href="/register" class="underline text-blue-500">Create an account !</a>
    </span>
</template>