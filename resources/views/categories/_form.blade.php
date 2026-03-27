<div>
    <label class="block text-sm text-gray-700 dark:text-gray-300">
        Name
    </label>

    <input type="text" name="name" value="{{ old('name', $category->name ?? '') }}" class="w-full mt-1 p-2 border rounded
                  bg-white dark:bg-gray-900
                  text-gray-900 dark:text-gray-100
                  border-gray-300 dark:border-gray-700">

    @error('name')
    <div class="text-red-500 text-sm mt-1">
        {{ $message }}
    </div>
    @enderror
</div>