<?php

namespace App\Http\Controllers;

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
        $todo = Todo::findOrFail($id);

        return new TodoResource($todo);
    }


}
