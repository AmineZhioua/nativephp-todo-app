<x-app-layout>
    <div class="mt-5 p-4">
        {{-- Heading --}}
        <div class="mb-4">
            <h1 class="font-bold text-2xl">Create a new Todo</h1>
            <p class="text-[#888] text-sm font-semibold">Organize your day by organizing your todos</p>
        </div>

        <form class="mt-2">
            {{-- Todo --}}
            <div class="flex flex-col gap-2">
                <label for="todo" class="px-2 font-semibold">Todo :</label>
                <textarea 
                    type="text" 
                    id="todo" 
                    name="todo" 
                    rows="5"
                    placeholder="Do the laundry" 
                    class="border p-2 rounded-2xl"
                ></textarea>
            </div>

            {{-- Status --}}
            <div class="flex items-center gap-2 mt-4">
                <label for="todo-status" class="px-2 font-semibold">Status :</label>
                <input type="checkbox" id="todo-status" name="todo-status" />
            </div>

            <button 
                type="button"
                class="bg-black rounded-xl text-center w-full text-white p-2 mt-4"
            >
                <i class="fa-solid fa-plus mr-2"></i>
                <span class="font-semibold">Add Todo</span>
            </button>
        </form>
    </div>
</x-app-layout>