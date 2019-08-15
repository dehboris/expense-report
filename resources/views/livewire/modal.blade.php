<div>
    @if($isOpen)
        <div class="fixed top-0 left-0 w-screen h-screen bg-black opacity-50 z-40" wire:click="toggle"></div>

        <div wire:transition.fade.500ms class="fixed top-0 left-0 w-full flex justify-center z-50">
            <div class="bg-white w-full max-w-lg rounded mt-4 md:mt-16">
                <div class="relative">
                    <div class="absolute right-0 text-xl cursor-pointer mr-3 -mt-1" wire:click="toggle">
                        &times;
                    </div>
                </div>
                <h3 class="border-b-2 border-gray-400 leading-none p-6">Delete Bucket</h3>

                <div class="leading-tight font-semibold p-6 border-b-2 borderg-gray-400">
                    Are you sure you want to delete this bucket? All items associated with it will also be deleted.
                </div>

                <div class="flex p-6">
                    <button class="font-bold bg-yellow-600 text-gray-100 rounded px-2 transition-fast hover:bg-yellow-700 mr-auto" wire:click="toggle">Cancel</button>
                    <button class="text-red-600 hover:underline" wire:click="submit">Delete</button>
                </div>
            </div>
        </div>
    @endif
</div>
