<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IpData;
use App\Models\AuditTrails;
use Illuminate\Support\Facades\Auth;
use Throwable;

class IpController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        $Ip = IpData::all();
        return response()->json([
            'data' => $Ip
        ]);
    }

    public function show($id) {
        $Ip = IpData::where('id',$id)->get(); // or can use ::find($id);
        return response()->json([
            'data' => $Ip
        ]);
    }

    public function create(Request $request) {
        $this->validate($request, [
            'ip' => 'required|ipv4',
            'label' => 'required',
        ]);

        $Ip = IpData::create([
            'ip'=> $request->input('ip'),
            'label' => $request->input('label')
        ]);

        if ($Ip) {
            //add audit trail
            AuditTrails::create([
                'user_id'=> Auth::user()->id,
                'action' => 'add ip',
                'ip'=> $request->input('ip'),
                'label' => $request->input('label'),
                'modify_date'=> date('Y-m-d H:i:s')
            ]);

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
        $this->validate($request, [
            'label' => 'required',
        ]);
        $IpCheck = IpData::where('id',$id)->get(); // or can use ::find($id);
        if (sizeof($IpCheck) == 0) {
            return response()->json(['success'=>false,'message' => 'Data not found'], 400);
        }

        try {
            $Ip = IpData::find($id);
            $Ip->update([
                'label' => $request->label
            ]);

            AuditTrails::create([
                'user_id'=> Auth::user()->id,
                'action' => 'update ip label',
                'ip'=> $Ip->ip,
                'label' => $request->label,
                'modify_date'=> date('Y-m-d H:i:s')
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
