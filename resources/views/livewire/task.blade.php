<div>
    {{-- The Master doesn't talk, he acts. --}}
    <div class="d-flex justify-content-start m-3 ">
        <button wire:click="openModal" class="btn btn-primary">Create New Task</button>
    </div>
    {{--modal--}}

    <!-- Modal -->
    @if($showModal)
        <div class="modal fade show d-block" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Create New Task</h5>
                        <button type="button" class="close" wire:click="closeModal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Task Form -->
                        <form wire:submit.prevent="storeTask">
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
                                    <option value="low">Low</option>
                                    <option value="medium">Medium</option>
                                    <option value="high">High</option>
                                </select>
                                @error('priority') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-group">
                                <label for="status">Status</label>
                                <select id="status" wire:model="status" class="form-control">
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
                                <button type="submit" class="btn btn-primary">Save Task</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif <!-- Modal -->
    @if($showModal)
        <div class="modal fade show d-block" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Create New Task</h5>
                        <button type="button" class="close" wire:click="closeModal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Task Form -->
                        <form wire:submit.prevent="storeTask">
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
                                    <option value="low">Low</option>
                                    <option value="medium">Medium</option>
                                    <option value="high">High</option>
                                </select>
                                @error('priority') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-group">
                                <label for="status">Status</label>
                                <select id="status" wire:model="status" class="form-control">
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
                                <button type="submit" class="btn btn-primary">Save Task</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif





    <table>
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
                        <div class="d-flex px-2 py-1">
                            <div>
                                <img src="{{ asset('assets') }}/img/team-2.jpg"
                                     class="avatar avatar-sm me-3 border-radius-lg"
                                     alt="user1">
                            </div>
                            <div class="d-flex flex-column justify-content-center">
                                <h6 class="mb-0 text-sm">{{ $todo->task_title }}</h6>
                                <p class="text-xs text-secondary mb-0">{{ $todo->description }}</p>
                            </div>
                        </div>
                    </td>
                    <td>
                        <p class="text-xs font-weight-bold mb-0">{{ $todo->priority }}</p>
                        <p class="text-xs text-secondary mb-0">Priority</p>
                    </td>
                    <td class="align-middle text-center text-sm">
                        <span class="badge badge-sm bg-gradient-success">{{ $todo->status }}</span>
                    </td>
                    <td class="align-middle text-center">
{{--                        <span class="text-secondary text-xs font-weight-bold">{{ $todo->deadline ? $todo->deadline->format('Y-m-d') : 'No Deadline' }}</span>--}}
                    </td>
                    <td class="align-middle">
                        <a href="javascript:;" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                            Edit
                        </a>
                        <a href="javascript:;" wire:click="delete({{ $todo->id }})" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Delete task">
                            Delete
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

</div>
