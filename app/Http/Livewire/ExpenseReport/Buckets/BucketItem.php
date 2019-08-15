<?php

namespace App\Http\Livewire\ExpenseReport\Buckets;

use App\ExpenseReport\Bucket;
use Livewire\Component;

class BucketItem extends Component
{
    public $item;
    public $loop;

    public function mount($item, $loop)
    {
        $this->item = $item;
        $this->loop = $loop;
    }

    public function render()
    {
        return view('livewire.expense-report.buckets.bucket-item');
    }

    public function submit()
    {
        \App\ExpenseReport\BucketItem::find($this->item['id'])->delete();

        $this->emit('updateBucket', $this->item['bucket_id']);
    }
}
