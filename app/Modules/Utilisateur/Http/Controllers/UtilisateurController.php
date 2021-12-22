<?php

namespace App\Modules\Utilisateur\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Utilisateur\Models\Utilisateur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UtilisateurController extends Controller
{
    public function index(){
        if(!auth()->user()->tokenCan("Admin"))
            return [
                "payload" => "Unauthorized !",
                "status" => "401"
            ];
        $rs=Utilisateur::all();

        return [
            "payload" => $rs,
            "status" => "200"
        ];
    }
    public function get($id){
        if(!auth()->user()->tokenCan("Admin"))
            return [
                "payload" => "Unauthorized !",
                "status" => "401"
            ];
        $crane=Utilisateur::find($id);
        if(!$crane){
            return [
                "payload" => "The searched row does not exist !",
                "status" => "404"
            ];
        }
        else {
            return [
                "payload" => $crane,
                "status" => "200"
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
            "username" => "required|unique:utilisateurs,username",
            "firstname" => "required|string",
            "lastname" => "required|string",
            "role" => "required|string",
        ]);
        if ($validator->fails()) {
            return [
                "payload" => $validator->errors(),
                "status" => "406"
            ];
        }
        $utilisateur=Utilisateur::make($request->except("password"));
        $utilisateur->password="Initial123";
        $utilisateur->save();
        return [
            "payload" => $utilisateur,
            "status" => "200"
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
            "username" => "required",
            "firstname" => "required|string",
            "lastname" => "required|string",
            "role" => "required|string",
        ]);
        if ($validator->fails()) {
            return [
                "payload" => $validator->errors(),
                "status" => "406"
            ];
        }
        $utilisateur=Utilisateur::find($request->id);
        if (!$utilisateur) {
            return [
                "payload" => "The searched row does not exist !",
                "status" => "404"
            ];
        }
        if(strtolower($request->username)!=strtolower($utilisateur->username)){
            if(Utilisateur::where("username",$request->username)->count()>0)
                return [
                    "payload" => "The username has been already taken ! ",
                    "status" => "407"
                ];
        }
        $utilisateur->username=strtolower($request->username);
        $utilisateur->firstname=strtolower($request->firstname);
        $utilisateur->lastname=strtolower($request->lastname);
        $utilisateur->role=$request->role;
        $utilisateur->save();
        return [
            "payload" => $utilisateur,
            "status" => "200"
        ];
    }
    public function delete(Request $request){
        if(!auth()->user()->tokenCan("Admin"))
            return [
                "payload" => "Unauthorized !",
                "status" => "401"
            ];
        $utilisateur=Utilisateur::find($request->id);
        if(!$utilisateur){
            return [
                "payload" => "The searched row does not exist !",
                "status" => "404"
            ];
        }
        else {
            $utilisateur->delete();
            return [
                "payload" => "Deleted successfully",
                "status" => "200"
            ];
        }
    }
    public function register(Request $request){
        $validator=Validator::make($request->all(),[
            "username" => "required|unique:utilisateurs,username",
            "email" => "string",
            "password" => "required|string|confirmed",
            "firstname" => "required|string",
            "lastname" => "required|string",
            "role" => "required|string",
            "shift" => "string",
        ]);
        if ($validator->fails()) {
            return [
                "payload" => $validator->errors(),
                "status" => "406"
            ];
        }
        $utilisateur=Utilisateur::create([
            "username" => $request->username,
            "email" => $request->email,
            "password" => $request->password,
            "firstname" => $request->firstname,
            "lastname" => $request->lastname,
            "role" => $request->role,
            "shift" => $request->shift,
        ]);
        $token = $utilisateur->createToken($request->role,[$request->role])->plainTextToken;
        $response = [
            "utilisateur" => $utilisateur,
            "token" => $token
        ];
        return [
            "payload" => $response,
            "status" => "200"
        ];
    }
    public function login(Request $request) {
        $validator=Validator::make($request->all(),[
            "username" => "required|string",
            "password" => "required|string",
        ]);
        if ($validator->fails()) {
            return [
                "payload" => $validator->errors(),
                "status" => "406"
            ];
        }

        $utilisateur = Utilisateur::where('username', $request->username)->first();
        if(!$utilisateur || !Hash::check($request->password, $utilisateur->password)) {
            return [
                "payload" => "Incorrect username or password !",
                "status" => "401"
            ];
        }
        $token = $utilisateur->createToken($utilisateur->role,[$utilisateur->role])->plainTextToken;
        $response = [
            'utilisateur' => $utilisateur,
            'token' => $token
        ];

        return [
            "payload" => $response,
            "status" => "200"
        ];

    }
    public function logout(Request $request) {
        auth()->user()->tokens()->delete();

        return [
            "payload" => "User Logged out successfully !",
            "status" => "200"
        ];
    }
    public function changePassword(Request $request){

        $validator = Validator::make($request->all(), [
            "id" => "required",
            "password" => "required|string|confirmed",

        ]);
        if ($validator->fails()) {
            return [
                "payload" => $validator->errors(),
                "status" => "406"
            ];
        }
        $utilisateur=Utilisateur::find($request->id);
        if (!$utilisateur) {
            return [
                "payload" => "The searched row does not exist !",
                "status" => "404"
            ];
        }


        $utilisateur->password=$request->password;

        $utilisateur->save();
        return [
            "payload" => $utilisateur,
            "status" => "200"
        ];
    }
}
