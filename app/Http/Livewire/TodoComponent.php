<?php

namespace App\Http\Livewire;

use App\Models\Todo;
use Livewire\Component;

class TodoComponent extends Component
{
    public $task_title, $description, $priority, $status, $deadline, $showModal = false, $editingTodoId = null;

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

    public function editTask($id)
    {
        $todo = Todo::find($id);
        if ($todo) {
            $this->editingTodoId = $todo->id;
            $this->task_title = $todo->task_title;
            $this->description = $todo->description;
            $this->priority = $todo->priority;
            $this->status = $todo->status;
            $this->deadline = $todo->deadline;
            $this->showModal = true;
        }
    }

    public function updateTask()
    {
        $this->validate();

        $todo = Todo::find($this->editingTodoId);
        if ($todo) {
            $todo->update([
                'task_title' => $this->task_title,
                'description' => $this->description,
                'priority' => $this->priority,
                'status' => $this->status,
                'deadline' => $this->deadline,
            ]);
        }

        $this->closeModal();
        $this->reset(['task_title', 'description', 'priority', 'status', 'deadline']);

        session()->flash('message', 'Task updated successfully!');
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

    public function deleteTask($taskId)
    {
        // Find the task by its ID and delete it
        $task = Todo::find($taskId);

        if ($task) {
            $task->delete();

            // Optionally, you can emit an event or flash a message
            session()->flash('success', 'Task deleted successfully.');

            // Refresh the tasks list
            $this->tasks = Todo::all();
        } else {
            session()->flash('error', 'Task not found.');
        }
    }
}
