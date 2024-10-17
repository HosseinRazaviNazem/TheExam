<?php

namespace App\Jobs;

use App\Models\Todo;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;



class ProcessTodo implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $todo;

    public function __construct(Todo $todo)
    {
        $this->todo = $todo;
    }

    public function handle()
    {
        Log::info('Processing Todo:', [
            'id' => $this->todo->id,
            'title' => $this->todo->title,
            'priority' => $this->todo->priority,
            'created_at' => $this->todo->created_at,
        ]);
    }
}
