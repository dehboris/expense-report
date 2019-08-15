<?php

namespace App\Http\Livewire;

use App\ExpenseReport\Bucket;
use Livewire\Component;

class Modal extends Component
{
    public $isOpen = false;

    public $bucket;

    protected $listeners = ['showModal' => 'toggle'];

    public function toggle()
    {
        $this->isOpen = !$this->isOpen;
    }

    public function submit()
    {
        Bucket::find($this->bucket['id'])->delete();

        request()->session()->flash('flash', [
            'type' => 'success',
            'message' => 'Bucket deleted successfully',
        ]);

        return redirect()->route('expense-report.buckets.index');
    }

    public function mount($bucket)
    {
        $this->bucket = $bucket;
    }

    public function render()
    {
        return view('livewire.modal');
    }
}
