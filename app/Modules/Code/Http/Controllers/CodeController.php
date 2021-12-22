<?php

namespace App\Modules\Code\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Code\Models\Code;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CodeController extends Controller
{

    public function index(){

        $rs=Code::all();

        return [
            "payload" => $rs,
            "status" => "200_00"
        ];
    }
    public function get($id){
        $code=Code::find($id);
        if(!$code){
            return [
                "payload" => "The searched row does not exist !",
                "status" => "404_1"
            ];
        }
        else {
            return [
                "payload" => $code,
                "status" => "200_1"
            ];
        }
    }
    public function create(Request $request){
        $validator = Validator::make($request->all(), [
            "code" => "required|string|unique:codes,code",
        ]);
        if ($validator->fails()) {
            return [
                "payload" => $validator->errors(),
                "status" => "406_2"
            ];
        }
        $code=Code::make($request->all());
        $code->save();
        return [
            "payload" => $code,
            "status" => "200"
        ];
    }
    public function update(Request $request){
        $validator = Validator::make($request->all(), [
            "id" => "required",
            "code" => "required",
        ]);
        if ($validator->fails()) {
            return [
                "payload" => $validator->errors(),
                "status" => "406_2"
            ];
        }
        $code=Code::find($request->id);
        if (!$code) {
            return [
                "payload" => "The searched row does not exist !",
                "status" => "404_3"
            ];
        }
        if($request->code!=$code->code){
            if(Code::where("code",$request->code)->count()>0)
                return [
                    "payload" => "The Code has been already taken ! ",
                    "status" => "406_2"
                ];
        }
        $code->code=$request->code;
        $code->description=$request->description;
        $code->category=$request->category;
        $code->save();
        return [
            "payload" => $code,
            "status" => "200"
        ];
    }
    public function delete(Request $request){
        $code=Code::find($request->id);
        if(!$code){
            return [
                "payload" => "The searched row does not exist !",
                "status" => "404_4"
            ];
        }
        else {
            $code->delete();
            return [
                "payload" => "Deleted successfully",
                "status" => "200_4"
            ];
        }
    }

}
