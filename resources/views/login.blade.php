<x-auth-layout>
    <div class="flex flex-col items-center justify-center h-full w-full gap-4">
        {{-- Heading --}}
        <div class="text-center">
            <h1 class="font-bold text-2xl mb-2">Sign In</h1>
            <p class="text-[#888]">Welcome to Todo app in NativePHP !</p>
        </div>

        {{-- Login Form --}}
        <login-form />
    </div>
</x-auth-layout>