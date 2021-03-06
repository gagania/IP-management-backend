<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AccessLogs;
use Illuminate\Support\Facades\Auth;
use Throwable;

class AccessLogController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        return response()->json([
            'data' => AccessLogs::with('user')->get()
        ]);
    }

    public function show($id) {
        $accessLog = AccessLogs::with('user')->where('id',$id)->get(); // or can use ::find($id);
        if ($accessLog) {
            return response()->json([
                'success' => true,
                'message' => 'Access Log Success',
                'data' => $accessLog
            ],200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Access Log Not Found',
                'data' => $accessLog
            ],401);
        }
    }
}
