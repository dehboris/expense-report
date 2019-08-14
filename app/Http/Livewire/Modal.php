<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Modal extends Component
{
    public $isOpen = false;

    public $bucket;

    public function toggle()
    {
        $this->isOpen = !$this->isOpen;
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
