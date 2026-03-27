<x-app-layout>
    @if(!$categories)
    <div colspan="2" class="p-6 text-center">
        <h2 class="text-gray-500 dark:text-gray-400 mb-3">
            No categories yet
        </h2>

        <a href="{{ route('categories.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded">
            Create your first category
        </a>
    </div>
    @endif
    <div class="pt-10 pl-50 pr-50">

        @if(session('success'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)"
            class="mb-4 p-4 rounded bg-green-100 text-green-800">

            {{ session('success') }}
        </div>
        @endif
        @if(count($categories) > 0)
        <div class="flex justify-between mb-4">
            <h1 class="text-xl font-semibold text-gray-900 dark:text-gray-100">
                Categories
            </h1>

            <a href="{{ route('categories.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded">
                Create
            </a>
        </div>
        <div class="bg-white dark:bg-gray-800 shadow rounded">
            <table class="w-full">
                <thead>
                    <tr class="border-b dark:border-gray-700">
                        <th class="p-3 text-left">Name</th>
                        <th class="p-3 text-left">Created</th>
                        <th class="p-3 text-left">Updated</th>
                        <th class="p-3 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                    <tr class="border-b dark:border-gray-700">
                        <td class="p-3">
                            {{ $category['name'] }}
                        </td>
                        <td class="p-3">
                            {{ $category['created_at'] ?? '-' }}
                        </td>

                        <td class="p-3">
                            {{ $category['updated_at'] ?? '-' }}
                        </td>
                        <td class="p-3 text-right space-x-2">
                            <a href="{{ route('categories.edit', ['category' => $category['id']]) }}"
                                class="text-blue-500">Edit</a>

                            <form method="POST"
                                action="{{ route('categories.destroy', ['category' => $category['id']]) }}"
                                class="inline">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-500">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-4">
                {{ $links() }}
            </div>
        </div>
        @endif
    </div>
</x-app-layout>