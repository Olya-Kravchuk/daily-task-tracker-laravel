<x-app-layout>
    <div class="p-6 max-w-xl">
        <h1 class="text-xl mb-4 text-gray-900 dark:text-gray-100">
            Create Category
        </h1>

        <form method="POST" action="{{ route('categories.store') }}">
            @csrf

            @include('categories._form')

            <button class="mt-4 px-4 py-2 bg-blue-600 text-white rounded">
                Save
            </button>
        </form>
    </div>
</x-app-layout>