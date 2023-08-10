<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use App\Http\Requests\TodoRequest;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user = Auth::user();
        if($user->state == 1 ) {

            $todos = Todo::all();
            return response()->json([
                "message" => "todo list",
                "data" => $todos,
            ], 200);
        } else {
            return response()->json([
                'message' => 'unauthorized',
            ], 401);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TodoRequest $request)
    {
        //
        $user = Auth::user();
        if($user->state == 1 ) {

            $todo = new Todo();
            $todo->task = $request->task;
            $todo->status = $request->status;
            $todo->created = $request->created;
            $todo->end = isset($request->end) ? $request->end : Carbon::now();

            $todo->user_id = Auth::user()->id;

            $todo->save();

            return response()->json([
                'message' =>  'task created successfully',
                'data' => $todo
            ], 201);
        } else {
            return response()->json([
                'message' => 'unauthorized',
            ], 401);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function show(Todo $todo)
    {
        //
        if(Auth::user()->state ==1) {
            if(isset($todo)) {
                $success = [
                    "data" => $todo,
                ];

                return $this->sendResponse($success, 'todo find');
            } else {
                $error = [];
                return $this->sendError($error, 'not found', 404);
            }
        } else {
            return $this->sendError( [], 'unauthorized', 404);
        }

        return $this->sendError( []);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function edit(Todo $todo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Todo $todo)
    {
        //
        $user = Auth::user();
        if(isset($todo)) {
            if($user->state == 1 && $todo->user_id == $user->id) {
                $lastTodo = $todo;
                $lastTodo->update($request->all());
                return $this->sendResponse(  [
                    'data' => $lastTodo,
                ], 'todo updated');
            }
        } else {
            return $this->sendError([],'not found', 404);
        }

        return $this->sendError( []);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Todo $todo)
    {
        //
        $user = Auth::user();
        $copy = $todo;
        if(isset($todo)) {
            if($user->role  != "admin"){
                if($user->state == 1 && $todo->user_id == $user->id) {
                    $todo->delete();
                    return $this->sendResponse(['data' => $copy], 'todo deleted', 204);
                } else {
                    return $this->sendResponse([], 'unauthorized', 404);

                }
            } else {
                $todo->delete();
                return response()->json([
                    'data' => $copy,
                    'message' => 'todo deleted',
                ], 204);
                // return $this->sendResponse('', 'todo deleted', 204);
            }
        } else {
            return $this->sendError([], 'not found', 404);
        }
        return $this->sendError( []);
    }
}
