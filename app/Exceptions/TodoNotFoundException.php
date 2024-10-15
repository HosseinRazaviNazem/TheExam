<?php

namespace App\Exceptions;

use Exception;

class TodoNotFoundException extends Exception
{
    public function __construct($message = 'Todo not found')
    {
        parent::__construct($message);
    }

    public function render()
    {
        return response()->json([
            'message' => $this->getMessage(),
        ], 404);
    }
}
