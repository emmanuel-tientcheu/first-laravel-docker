<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserRequest;
use Optimus\Bruno\EloquentBuilderTrait;
use Optimus\Bruno\LaravelController;

class UserController extends LaravelController
{
    use EloquentBuilderTrait;
    /**
     * register user
     */
    public function register(Request $request)
    {
       // $validator = Validator::make($request->all(), [
       //     'email' => 'required|email',
       //     'password' => 'required',
       // ]);

       // if($validator->fails()) {
       //     return $this->sendError('Validation Error.', $validator->errors());
       // }

       $user = new User();
       $user->name = $request->name;
       $user->email = $request->email;
       $user->state = $request->state;
       $user->role = $request->role;
       $user->password = bcrypt($request->password);
       $user->save();

       $success = [
           'token' => $user->createToken('first_laradock')->plainTextToken,
           'name' => $user->name,
       ];

       return response()->json([
        "data" => $success,
        "message"=>'user register successfully'
        ],200);

    }

    /**
      * login user
      */

    public function login(Request $request)
    {
      $validator = Validator::make($request->all(), [
      'email' => 'required|email',
      'password' => 'required',
      ]);

      if($validator->fails()) {
          return $this->sendError('Validation Error.', $validator->errors());
      }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = User::whereEmail($request->email)->first();
            $token = $user->createToken('first_laradock')->plainTextToken;
            $success = [
                'token' => $token,
                'name' => $user->name,
            ];

            return response()->json([
                "data" => $success,
                "message" => 'User login successfully.'
                ], 200);
        } else {
            return response()->json([
                "message" => "Unauthorized"
            ], 403);
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // $users = User::query()->whereState(1)->get();
        // return response()->json([
        //     "message" => "user list",
        //     "data" => $users
        // ], 200);

        if(Auth::user()->state == 1) {

            $resourceOptions = $this->parseResourceOptions();
            $query = User::query();

            $this->applyResourceOptions($query, $resourceOptions);
            $books = $query->get();

            $parsedData = $this->parseData($books, $resourceOptions, 'users');
            return $this->response($parsedData);
        }else {
            return response()->json([
                'message' => 'unauthorized'
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
    public function store(UserRequest $request)
    {
        //
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->state = $request->state;
        $user->role = $request->role;

        $user->save();
        return response()->json([
            "message" => "user created successfully",
            "data" => $user,
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
        $userLog = Auth::user();
        if($userLog->id == $user->id || $userLog->role == "admin") {
            if(isset($user)) {

             $resourceOptions = $this->parseResourceOptions();
             $query = User::query()->whereId($user->id);

             $this->applyResourceOptions($query, $resourceOptions);
             $user = $query->get();

            $parsedData = $this->parseData($user, $resourceOptions, 'users');

            return response()->json([
                    "message" => 'user find',
                    "data" => $parsedData
                ]);

            } else {
                return response()->json([
                    "message" => "not found"
                ], 404);
            }
        } else {
            return response()->json([
                "message" => 'unauthorized'
            ], 401);
        }

        return response()->json([], 403);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
