<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Alert extends Component
{
    private $type;
    public $show = false;
    public $message;
    public $classes;

    public function mount($alert)
    {
        if ($alert) {
            $this->type = $alert['type'];
            $this->message = $alert['message'];
            $this->classes = $this->setClasses();
            $this->toggle();
        }
    }

    public function render()
    {
        return view('livewire.alert');
    }

    protected function setClasses()
    {
        if ($this->type === 'success') {
            return 'bg-green-200 text-green-900 border-green-700';
        } else if ($this->type === 'danger') {
            return 'bg-red-200 text-red-900 border-red-700';
        } else if ($this->type === 'warning') {
            return 'bg-yellow-300 text-yellow-900 border-yellow-500';
        } else {
            return 'bg-blue-200 text-blue-900 border-blue-700';
        }
    }

    public function toggle()
    {
        $this->show = !$this->show;
    }
}
