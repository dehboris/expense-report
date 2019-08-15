<div wire:transition.fade.150ms class="group w-full flex flex-wrap border-b-2 py-2{{ is_array($loop) ? $loop['last'] ? ' border-none' : '' : $loop->last ? ' border-none' : '' }} md:px-4">

    <div class="w-full sm:w-9/12 font-semibold pr-1 sm:pr-0">
        <span class="font-bold sm:hidden text-gray-900">Name:</span>
        <span>{{ $item['name'] }}</span>
    </div>
    <div class="w-full flex self-center justify-between pl-10 sm:w-2/12 sm:text-right">
        <span class="font-bold sm:hidden">Amount:</span>
        <span>$</span>
        <span class="tracking-wide {{ $item['type'] === App\ExpenseReport\BucketItem::DEBIT ? 'text-red-700' : 'text-green-700' }}">
            {{ str_replace('$', '', is_array($item['amount']) ? $item['amount']['formatted'] : $item['amount']) }}
        </span>
    </div>
    <div class="sm:w-1/12 text-right self-center">
        <a class="text-xs text-red-700 cursor-pointer hidden group-hover:block hover:underline" wire:click="submit">Delete</a>
    </div>
</div>
