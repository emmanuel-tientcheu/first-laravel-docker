<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Todo;
use App\Http\Requests\CommentRequest;

class CommentController extends Controller
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
        if($user->state == 1) {
            $comment = Comment::all();
            $success = [
                "data" => $comment
            ];
            return $this->sendResponse($success, 'list of comment');
        } else {
                $error = [];
            return $this->sendError($error, 'unauthorized', 401);
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
    public function store(CommentRequest $request)
    {
        //
        $comment = new Comment();
        $comment->message = $request->message;
        $comment->view = $request->view;
        $comment->todo_id = isset($request->todo_id) ? $request->todo_id : Todo::whereStatus(1)->inRandomOrder()->first()->id;
        $comment->user_id = Auth::user()->id;
        $comment->deletable = $request->deletable;

        if(Auth::user()->state == 1) {
            $comment->save();
            $success = [
                'comments' => $comment,
            ];
            return $this->sendResponse($success, 'comment created successfully', 201);
        } else {
            $error = [];
            return $this->sendError($error, 'unauthorized', 401);
        }

        return $this->sendError($error = [
            'success' => false
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
        if(Auth::user()->state ==1) {
            if(isset($comment)) {
                $success = [
                    "data" => $comment,
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
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        //
        $user = Auth::user();
        if(isset($comment)) {
            if($user->state == 1 && $comment->user_id == $user->id) {
                $lasComment = $comment;
                $lasComment->update($request->all());
                return $this->sendResponse(  [
                    'data' => $lasComment,
                ], 'comment updated');
            }
        } else {
            return $this->sendError([],'not found', 404);
        }

        return $this->sendError( []);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        //

        $user = Auth::user();
        $copy = $comment;
        if(isset($comment)) {
            if($user->role  != "admin"){
                if($user->state == 1 && $comment->user_id == $user->id) {
                    $comment->delete();
                    // return $this->sendResponse(['data' => $copy], 'todo deleted', 204);
                    return response()->json([
                        'data' => $copy,
                        'message' => 'comment deleted'
                    ],204);
                } else {
                    // return $this->sendResponse([], 'unauthorized', 404);
                    return response()->json([
                        'message' => 'unauthorized'
                    ],401);
                }
            } else {
                $comment->delete();
                return response()->json([
                    'data' => $copy,
                    'message' => 'comment deleted'
                ],204);
                // return $this->sendResponse(['data' => $copy], 'todo deleted', 204);
            }
        } else {
            // return $this->sendError([], 'not found', 404);
            return response()->json([
                'message' => 'not found'
            ],404);
        }
        return $this->sendError( []);
        return response()->json([
        ],403);
    }
}
