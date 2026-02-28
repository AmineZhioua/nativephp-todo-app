<script lang="ts" setup>
import { ref } from 'vue';
import { AuthService } from '../services/auth.service';
import { useToast, Toast } from 'primevue';

    defineOptions({
        name: "RegisterForm"
    });

    // SETUP
    const authService = new AuthService();
    const toast = useToast();

    // DATA
    const username = ref("");
    const email = ref("");
    const password = ref("");
    const confirmedPassword = ref("");

    const error = ref("");

    const isSubmitting = ref(false);

    // METHODS
    async function registerUser() {
        error.value = "";
        if (isSubmitting.value) return;

        isSubmitting.value = true;

        try {
            const registerResponse = await authService.register({
                username: username.value,
                email: email.value,
                password: password.value,
                confirmedPassword: confirmedPassword.value
            });

            if (registerResponse.status === 201) {
                toast.add({
                    severity: "success",
                    summary: "Succès",
                    detail: "Account successfully created"
                });
            }
        } catch (err) {
            error.value = err ?? "Something went wrong.";
            console.log(err)
        } finally {
            isSubmitting.value = false;
        }
    };
</script>

<template>
    <form class="flex flex-col gap-4 w-full px-4" @submit.prevent="registerUser">
        <div v-if="error">
            {{ error }}
        </div>
        <!-- Username -->
        <div class="flex flex-col gap-2">
            <label for="email">Username:</label>
            <input 
                type="text" 
                id="username" 
                name="username" 
                placeholder="John Doe"
                class="border p-2 rounded-2xl"
                v-model="username"
            />
        </div>

        <!-- Email -->
        <div class="flex flex-col gap-2">
            <label for="email">Email:</label>
            <input 
                type="email" 
                id="email" 
                name="email" 
                placeholder="Your Email"
                class="border p-2 rounded-2xl"
                v-model="email"
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
                v-model="password"
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
                v-model="confirmedPassword"
            />
        </div>

        <button 
            type="submit"
            class="bg-black text-white p-2 rounded-xl mt-2 z-50"
        >
            <span class="font-semibold">Create my account</span>
        </button>
    </form>

    <span class="text-sm">
        Already a member ? 
        <a href="/login" class="underline text-blue-500">Sign In !</a>
    </span>

    <Toast />
</template>