<div>
    @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <button class="btn btn-primary" wire:click="openModal">Create New Task</button>

    {{-- Todo Table --}}
    <table class="table mt-3">
        <thead>
        <tr>
            <th>Task</th>
            <th>Description</th>
            <th>Priority</th>
            <th>Status</th>
            <th>Deadline</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($todos as $todo)
            <tr>
                <td>
                    <h6 class="mb-0 text-sm">{{ $todo->task_title }}</h6>
                </td>
                <td>
                    <p class="mb-0 text-sm">{{ Str::limit($todo->description, 15, '...') }}</p>
                </td>
                <td>
                    <p class="text-xs font-weight-bold mb-0">{{ $todo->priority }}</p>
                </td>
                <td class="align-middle text-center text-sm">
                    <span class="badge badge-sm bg-gradient-success">{{ $todo->status }}</span>
                </td>
                <td class="align-middle text-center">
                    <span class="text-secondary text-xs font-weight-bold">
                        {{ \App\Helpers\JalaliHelper::convertToJalali($todo->deadline) }}
                    </span>
                </td>
                <td class="align-middle">
                    <a href="javascript:;" wire:click="editTask({{ $todo->id }})"
                       class="text-secondary font-weight-bold text-xs" data-toggle="tooltip"
                       data-original-title="Edit task">
                        Edit
                    </a>
                    <a href="javascript:;" wire:click="deleteTask({{ $todo->id }})"
                       class="text-secondary font-weight-bold text-xs" data-toggle="tooltip"
                       data-original-title="Delete task">
                        Delete
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{-- Modal for creating and editing tasks --}}
    @if($showModal)
        <div class="modal fade show d-block" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ $editingTodoId ? 'Edit Task' : 'Create New Task' }}</h5>
                        <button type="button" class="close" wire:click="closeModal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form wire:submit.prevent="{{ $editingTodoId ? 'updateTask' : 'storeTask' }}">
                            <div class="form-group">
                                <label for="task_title">Task Title</label>
                                <input type="text" id="task_title" wire:model="task_title" class="form-control">
                                @error('task_title') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea id="description" wire:model="description" class="form-control"></textarea>
                                @error('description') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-group">
                                <label for="priority">Priority</label>
                                <select id="priority" wire:model="priority" class="form-control">
                                    <option value="">Select Priority</option>
                                    <option value="low">Low</option>
                                    <option value="medium">Medium</option>
                                    <option value="high">High</option>
                                </select>
                                @error('priority') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-group">
                                <label for="status">Status</label>
                                <select id="status" wire:model="status" class="form-control">
                                    <option value="">Select Status</option>
                                    <option value="pending">Pending</option>
                                    <option value="in progress">In Progress</option>
                                    <option value="completed">Completed</option>
                                </select>
                                @error('status') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-group">
                                <label for="deadline">Deadline</label>
                                <input type="date" id="deadline" wire:model="deadline" class="form-control">
                                @error('deadline') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" wire:click="closeModal">Close</button>
                                <button type="submit" class="btn btn-primary">{{ $editingTodoId ? 'Update Task' : 'Save Task' }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
