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
        $invoice = Todo::create($request->validated());

        return new TodoResource($invoice);

    }
}
