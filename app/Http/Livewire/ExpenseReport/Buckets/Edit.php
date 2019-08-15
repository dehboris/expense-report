<?php

namespace App\Http\Livewire\ExpenseReport\Buckets;

use App\ExpenseReport\Bucket;
use Livewire\Component;

class Edit extends Component
{
    public $bucket;

    public $name;
    public $description;

    public function mount(Bucket $bucket)
    {
        $this->bucket = $bucket;
        $this->name = $bucket->name;
        $this->description = $bucket->description;
    }

    public function submit()
    {
        $this->validate([
            'name' => 'required|string|max:100',
            'description' => 'nullable|string|max:255',
        ]);

        Bucket::where('id', $this->bucket['id'])
            ->update([
                'name' => $this->name,
                'description' => $this->description,
            ]);

        request()->session()->flash('flash', [
            'type' => 'success',
            'message' => 'Bucket updated successfully',
        ]);

        return redirect()->route('expense-report.buckets.show', $this->bucket);
    }

    public function render()
    {
        return view('livewire.expense-report.buckets.edit');
    }
}
