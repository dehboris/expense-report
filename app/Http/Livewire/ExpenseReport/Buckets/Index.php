<?php

namespace App\Http\Livewire\ExpenseReport\Buckets;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.expense-report.buckets.index', [
            'buckets' => Auth::user()->buckets,
        ]);
    }
}
