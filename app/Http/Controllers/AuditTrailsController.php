<?php

namespace App\Http\Controllers;

use App\Models\AuditTrails;

class AuditTrailsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        return response()->json([
            'data' => AuditTrails::with('user')->get()
        ]);
    }

    public function show($id) {
        $auditTrails = AuditTrails::with('user')->where('id',$id)->get(); // or can use ::find($id);
        return response()->json([
            'data' => $auditTrails
        ]);
    }
}
