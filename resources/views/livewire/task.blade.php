<div>
    {{-- The Master doesn't talk, he acts. --}}
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
