<?php

namespace App\Http\Controllers;

use App\Exceptions\TodoNotFoundException;
use App\Http\Requests\Todo\StoreTodoRequest;
use App\Http\Resources\Todo\TodoCollection;
use App\Http\Resources\Todo\TodoResource;
use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    //
    public function index()
    {
        return new TodoCollection(Todo::paginate());
    }

    public function store(StoreTodoRequest $request)
    {
        $todo = Todo::create($request->validated());

        return new TodoResource($todo);
    }

    public function show($id)
    {
        $todo = Todo::find($id);

        if (!$todo) {
            // Throw custom exception if Todo is not found
            throw new TodoNotFoundException();
        }

        return new TodoResource($todo);
    }


    public function edit(StoreTodoRequest $request, Todo $todo)
    {
        $todo->update($request->validated());
        return new TodoResource(Todo::paginate($todo));
    }


    public function destroy($id)
    {
        try {
            $todo = Todo::find($id);
            $todo->delete();
            return response()->json([
                'message' => 'Todo deleted successfully',
                'data' => new TodoCollection(Todo::paginate()),
            ]);

        } catch (TodoNotFoundException $e) {
            return response()->json([
                'message' => 'Todo not found',
            ], 404);

        }
    }
}



