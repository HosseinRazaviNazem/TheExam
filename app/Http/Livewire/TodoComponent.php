<?php

namespace App\Http\Livewire;

use App\Models\Todo;
use Livewire\Component;

class TodoComponent extends Component
{
    public $task_title, $description, $priority, $status, $deadline, $showModal = false;

    protected $rules = [
        'task_title' => 'required|string|max:255',
        'description' => 'required|string',
        'priority' => 'required|in:low,medium,high',
        'status' => 'required|in:pending,in progress,completed',
        'deadline' => 'required|date',
    ];

    public function storeTask(): void
    {
        $this->validate();

        Todo::create([
            'task_title' => $this->task_title,
            'description' => $this->description,
            'priority' => $this->priority,
            'status' => $this->status,
            'deadline' => $this->deadline,
        ]);

        $this->closeModal();
        $this->reset(['task_title', 'description', 'priority', 'status', 'deadline']);

        session()->flash('message', 'Task created successfully!');
    }

    public function closeModal()
    {
        $this->showModal = false;
    }
    public function openModal()
    {
        $this->showModal = true; // Set showModal to true to open the modal
    }


    public function render()
    {
        $todos = Todo::all();
        return view('livewire.todo', compact('todos'));
    }
}
