<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\ApiController;

class ListUserController extends ApiController
{
    /**
     * Display a listing of the resource.
     */
    public function listuser()
    {

       $user = auth()->user();

    //    dd($user);

        $users = User::all();

        $allow = Gate::allows('list_user' , $user);

        if($allow){

            return $this->successResponse($users,200);
        }


    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {

       $todos = $user->todos;


      return $this->successResponse([
       'todos'=> $todos,
       'name'=>$user->name



    ],200);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
