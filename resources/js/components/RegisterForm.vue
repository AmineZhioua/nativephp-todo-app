<script lang="ts" setup>
    defineOptions({
        name: "RegisterForm"
    });
</script>

<template>
    <form class="flex flex-col gap-4 w-full px-4">
        <!-- Email -->
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

        <!-- Password -->
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

        <!-- Confirm Password -->
        <div class="flex flex-col gap-2">
            <label for="confirm-password">Confirm password:</label>
            <input 
                type="password" 
                id="confirm-password" 
                name="confirm-password" 
                placeholder="Confirm your password"
                class="border p-2 rounded-2xl"
            />
        </div>

        <button 
            type="button"
            class="bg-black text-white p-2 rounded-xl mt-2"
        >
            <span class="font-semibold">Create my account</span>
        </button>
    </form>

    <span class="text-sm">
        Already a member ? 
        <a href="/login" class="underline text-blue-500">Sign In !</a>
    </span>
</template>