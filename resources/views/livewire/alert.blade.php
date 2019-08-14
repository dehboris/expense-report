<div>
    @if($show)
        <div wire:transition.fade.500ms class="font-semibold w-full max-w-xl rounded-b border-t-8 mx-auto py-3 px-4 {{ $classes }} -mt-6">
            <div class="relative">
                <div wire:click="toggle" class="absolute right-0 text-xl leading-none -mr-2 -mt-2 cursor-pointer">
                    &times;
                </div>
            </div>
            {{ $message }}
        </div>
    @else
        <div role="presentation" class="w-full h-16 -mt-6"></div>
    @endif
</div>
