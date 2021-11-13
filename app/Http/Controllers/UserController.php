<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::all();

        if ($user) {
            return response()->json([
                'success' => true,
                'message' => 'user found',
                'data' => $user
            ],200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'user not found',
                'data' => ''
            ],404);
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
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);

        if ($user) {
            return response()->json([
                'success' => true,
                'message' => 'user found',
                'data' => $user
            ],200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'user not found',
                'data' => ''
            ],404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function logout() { 
        // return Auth;
        if (Auth::check()) {
            Auth::user()->AauthAcessToken()->delete();
            return response()->json([
                'success' => true,
                'message' => 'Logout Success',
                'data' => ''
            ],200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Logout Fail',
                'data' => ''
            ],401);
            
        }
        
    }
}
