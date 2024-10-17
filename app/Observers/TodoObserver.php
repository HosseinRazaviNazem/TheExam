<?php

namespace App\Observers;

use App\Jobs\ProcessTask;
use App\Models\Todo;

class TodoObserver
{

    public function created(Todo $todo): void
    {
        ProcessTask::dispatch($todo);
    }
}
