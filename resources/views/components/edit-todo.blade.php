<x-app-layout>
    <div class="mt-5 p-4">
        <div class="mb-4">
            <h1 class="font-bold text-2xl">Edit Todo</h1>
            <p class="text-[#888] text-sm font-semibold">Each new todo is a step forward</p>
        </div>

        <todo-edit :todo-id="{{ $id }}" />
    </div>
</x-app-layout>