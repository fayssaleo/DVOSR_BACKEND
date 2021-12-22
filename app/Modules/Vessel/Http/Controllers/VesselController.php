<?php

namespace App\Modules\Vessel\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Vessel\Models\Vessel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VesselController extends Controller
{
    public function index(){
        if(!auth()->user()->tokenCan("Admin"))
            return [
                "payload" => "Unauthorized !",
                "status" => "401"
            ];
        $rs=Vessel::all();

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
        $vessel=Vessel::find($id);
        if(!$vessel){
            return [
                "payload" => "The searched row does not exist !",
                "status" => "404_1"
            ];
        }
        else {
            return [
                "payload" => $vessel,
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
            "voy_no" => "required|string",
            "vessel_name" => "required|string",
            "service" => "required|string",
            "eta" => "date",
            "etd" => "date",
        ]);
        if ($validator->fails()) {
            return [
                "payload" => $validator->errors(),
                "status" => "406_2"
            ];
        }
        $vessel=Vessel::make($request->all());
        $vessel->save();
        return [
            "payload" => $vessel,
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
            "voy_id" => "string|required",
            "vessel_name" => "required|string",
            "service" => "string",
            "eta" => "date",
            "etd" => "date",
        ]);
        if ($validator->fails()) {
            return [
                "payload" => $validator->errors(),
                "status" => "406_3"
            ];
        }
        $vessel=Vessel::find($request->id);
        if (!$vessel) {
            return [
                "payload" => "The searched row does not exist !",
                "status" => "404_3"
            ];
        }
        $vessel->voy_id=$request->voy_id;
        $vessel->vessel_name=$request->vessel_name;
        $vessel->service=$request->service;
        $vessel->eta=$request->eta;
        $vessel->etd=$request->etd;
        $vessel->save();
        return [
            "payload" => $vessel,
            "status" => "200_3"
        ];
    }
    public function delete(Request $request){
        if(!auth()->user()->tokenCan("Admin"))
            return [
                "payload" => "Unauthorized !",
                "status" => "401"
            ];
        $vessel=Vessel::find($request->id);
        if(!$vessel){
            return [
                "payload" => "The searched row does not exist !",
                "status" => "404_4"
            ];
        }
        else {
            $vessel->delete();
            return [
                "payload" => "Deleted successfully",
                "status" => "404_4"
            ];
        }
    }
}
