<div class="max-w-5xl mx-auto sm:px-4">
    <h1 class="text-3xl text-center md:mb-10">Editing Bucket</h1>

    <div class="p-4 sm:shadow-lg sm:p-10">
        <a class="inline-block mb-4 text-red-800 hover:underline" href="{{ route('expense-report.buckets.show', $bucket) }}">Back</a>
        <div class="w-full flex flex-wrap">
            <div class="w-full mb-3 md:w-5/12 md:px-3 md:mb-0">
                <label for="name" class="block font-semibold">Bucket Name:</label>
                <input type="text" id="name" name="name" class="input @error('name') border-red-500 @enderror" placeholder="Soccer Team" wire:model.lazy="name">

                @error('name')
                <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="w-full mb-6 md:w-5/12 md:px-3 md:mb-0">
                <label for="description" class="block font-semibold">Bucket Description:</label>
                <input type="text" id="description" name="description" class="input @error('description') border-red-500 @enderror" placeholder="Soccer team 2019 season expenses" wire:model.lazy="description">

                @error('description')
                <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="w-full flex justify-end md:w-2/12 md:px-3{{ $errors->any() ? ' self-center' : ' self-end' }}">
                <button class="transition-normal bg-green-600 text-gray-100 font-semibold rounded py-1 px-3 hover:bg-green-700" wire:click="submit">Update</button>
            </div>
        </div>
    </div>
</div>
