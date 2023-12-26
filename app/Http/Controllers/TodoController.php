<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\TodoRequest;
use App\Http\Requests\EditTodoRequest;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Validator;

class TodoController extends ApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TodoRequest $request)
    {

        $todo = Todo::create([
            'title' => $request->title,
            'user_id' => $request->user_id,

        ]);

       return  $this->successResponse($todo,201);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Todo $todo)
    {
        $task = auth()->user()->todos()->where('id', $todo->id);

        $task->update([

            'status'=>$request->status

        ]);
        return $this->successResponse($task->get(),200);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Todo $todo)
    {



     $task = auth()->user()->todos()->where('id', $todo->id)->delete();




       return $this->successResponse($task,200);
    }



    public function edittodo(EditTodoRequest $request, Todo $todo)
    {

        $task = auth()->user()->todos()->where('id', $todo->id);

        $task->update([

            'title'=>$request->title

        ]);
        return $this->successResponse($task->get(),200);



    }
}
