<x-app-layout>
    {{-- Main Section --}}
    <div class="mt-4 p-4">
        <h1 class="font-bold text-2xl mb-4">Your Todos</h1>

        {{-- Todo Cards Section --}}
        <todo-section />
    </div>

    {{-- Add a Todo Button --}}
    <button 
        class="absolute bg-white py-2 px-3 rounded-full shadow-md text-center bottom-0 right-5"
    >
        <a href="{{ route('create-todo') }}">
            <i class="fa-solid fa-plus"></i>
        </a>
    </button>
</x-app-layout>