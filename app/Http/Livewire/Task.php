<?php

namespace App\Http\Livewire;

use App\Models\Todo;
use Livewire\Component;

class Task extends Component
{


    public $todos;
    public $task_title, $description, $priority, $status, $deadline;
    public $showModal = false;

    public function mount()

    {
        $this->todos = Todo::all();
    }
    public function openModal()
    {
        $this->resetForm();
        $this->showModal = true;
    }
    public function closeModal()
    {
        $this->showModal = false;
    }

    public function storeTask()
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
        $this->resetForm();
        session()->flash('message', 'Task created successfully!');
    }

    // Reset the form fields
    private function resetForm()
    {
        $this->task_title = '';
        $this->description = '';
        $this->priority = 'medium';
        $this->status = 'pending';
        $this->deadline = null;
    }


    public function delete($id)
    {
        $todo = Todo::findOrFail($id);
        $todo->delete();

        // Re-fetch todos
        $this->todos = Todo::all();
    }
    public function render()
    {
        return view('livewire.task');
    }
}
