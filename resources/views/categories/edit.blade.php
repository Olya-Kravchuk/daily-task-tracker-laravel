<x-app-layout>
    <div class="p-6 max-w-xl">
        <h1 class="text-xl mb-4 text-gray-900 dark:text-gray-100">
            Edit Category
        </h1>

        <form method="POST" action="{{ route('categories.update', $category) }}">
            @csrf
            @method('PUT')

            @include('categories._form', ['category' => $category])

            <button class="mt-4 px-4 py-2 bg-blue-600 text-white rounded">
                Update
            </button>
        </form>
    </div>
</x-app-layout>