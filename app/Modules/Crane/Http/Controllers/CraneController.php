<?php

namespace App\Modules\Crane\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Crane\Models\Crane;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CraneController extends Controller
{
    public function index(){

        $rs=Crane::all();

        return [
            "payload" => $rs,
            "status" => "200_00"
        ];
    }
    public function get($id){
        if(!auth()->user()->tokenCan("Admin"))
            return [
                "payload" => "Unauthorized !",
                "status" => "401"
            ];
        $crane=Crane::find($id);
        if(!$crane){
            return [
                "payload" => "The searched row does not exist !",
                "status" => "404_1"
            ];
        }
        else {
            return [
                "payload" => $crane,
                "status" => "200_1"
            ];

        }
    }
    public function create(Request $request){
        if(!auth()->user()->tokenCan("Admin"))
            return [
                "payload" => "Unauthorized !",
                "status" => "401"
            ];
        $validator = Validator::make($request->all(), [
            "craneId" => "required|string",
        ]);
        if ($validator->fails()) {
            return [
                "payload" => $validator->errors(),
                "status" => "406_2"
            ];
        }
        $crane=Crane::make($request->all());
        $crane->save();
        return [
            "payload" => $crane,
            "status" => "200_2"
        ];
    }
    public function update(Request $request){
        if(!auth()->user()->tokenCan("Admin"))
            return [
                "payload" => "Unauthorized !",
                "status" => "401"
            ];
        $validator = Validator::make($request->all(), [
            "id" => "required",
            "craneId" => "required|string",
        ]);
        if ($validator->fails()) {
            return [
                "payload" => $validator->errors(),
                "status" => "406_3"
            ];
        }
        $crane=Crane::find($request->id);
        if (!$crane) {
            return [
                "payload" => "The searched row does not exist !",
                "status" => "404_3"
            ];
        }
        $crane->craneId=$request->craneId;
        $crane->save();
        return [
            "payload" => $crane,
            "status" => "200_3"
        ];
    }
    public function delete(Request $request){
        if(!auth()->user()->tokenCan("Admin"))
            return [
                "payload" => "Unauthorized !",
                "status" => "401"
            ];
        $crane=Crane::find($request->id);
        if(!$crane){
            return [
                "payload" => "The searched row does not exist !",
                "status" => "404_4"
            ];
        }
        else {
            $crane->delete();
            return [
                "payload" => "Deleted successfully",
                "status" => "200_4"
            ];
        }
    }
}
