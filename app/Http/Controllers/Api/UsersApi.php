<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UsersApi extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::take(2)->get();
    
        return response()->json([
            'status' => true,
            'message' => 'Data Retrieved successfully!',
            'users' => $users
        ]);
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->id_level = $request->id_level;

        $user->save();

        return response()->json([
            'status' => true,
            'message' => "Data Created successfully!",
            'user' => $user
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->id_level = $request->id_level;

        $user->update();

        return response()->json([
            'status' => true,
            'message' => "Data Updated successfully!",
            'user' => $user
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);

        $user->delete();

        return response()->json([
            'status' => true,
            'message' => "Data Deleted successfully!",
        ]);
    }
}
