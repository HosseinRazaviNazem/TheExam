<?php

namespace App\Http\Livewire;

use App\Models\Todo;
use Livewire\Component;

class Task extends Component
{

    public $todos;
    public function mount()

    {
        $this->todos = Todo::all();
    }
    public function render()
    {
        return view('livewire.task');
    }
}
