<?php

namespace App\Http\Livewire\ExpenseReport\Buckets;

use App\ExpenseReport\Bucket;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Create extends Component
{
    public $bucket = null;
    public $name;
    public $description;

    public function mount($bucket = null)
    {
        if ($bucket) {
            $this->bucket = $bucket;
            $this->name = $bucket->name;
            $this->description = $bucket->description;
        }
    }

    public function submit()
    {
        $this->validate([
            'name' => 'required|string|max:100',
            'description' => 'nullable|string|max:255',
        ]);

        Bucket::create([
            'user_id' => Auth::user()->id ,
            'name' => $this->name,
            'description' => $this->description,
        ]);

        request()->session()->flash('flash', [
            'type' => 'success',
            'message' => 'Bucket created successfully',
        ]);

        return redirect()->route('expense-report.buckets.index');
    }

    public function render()
    {
        return view('livewire.expense-report.buckets.create');
    }
}
