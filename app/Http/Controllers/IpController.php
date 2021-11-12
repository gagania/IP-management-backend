<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ip;
use Throwable;

class IpController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        $Ip = Ip::all();
        return response()->json([
            'data' => $Ip
        ]);
    }

    public function show($id) {
        $Ip = Ip::where('id',$id)->get(); // or can use ::find($id);
        return response()->json([
            'data' => $Ip
        ]);
    }

    public function create(Request $request) {
        $this->validate($request, [
            'ip' => 'required',
            'label' => 'required',
        ]);

        $name = $request->input('name');
        $Ip = Ip::create([
            'name'=> $name
        ]);

        if ($Ip) {
            return response()->json([
                'success'=> true,
                'message' => 'Add Ip Success!',
                'data'=> $Ip
            ],200);
        } else {
            return response()->json([
                'success'=> false,
                'message' => 'Add Ip Fail!',
                'data'=> ''
            ],404);
        }
    }

    public function update(Request $request,$id) {
        $this->validate($request, ['name' => 'required']);
        $IpCheck = Ip::where('id',$id)->get(); // or can use ::find($id);
        if (sizeof($IpCheck) == 0) {
            return response()->json(['success'=>false,'message' => 'Data not found'], 400);
        }

        try {
            $Ip = Ip::find($id);
            $Ip->update([
                'name' => $request->name
            ]);
            $success = true;
            $message = 'Update Ip Success';
            $data = $Ip;
            $status = 200;
        } catch (Throwable $th) {
            $success = false;
            $message = 'Update Ip Fail';
            $data = '';
            $status = 400;
        }
        
        return response()->json([
            'success'=> $success,
            'message' => $message,
            'data'=> $data
        ],$status);
    }
}
