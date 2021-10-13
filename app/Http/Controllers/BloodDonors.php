<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Blood;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class BloodDonors extends Controller
{
    //
    private function createValidator(Request $request)
    {

        return Validator::make($request->all(), [
            "firstname" => "required|string",
            "lastname" => "required|string",
            "email" => "required|email|unique:bloods",
            "phone" => "required|numeric",
            "blood_group" => "required|ends_with:+,-",
            "location" => "required|string",
        ]);
    }


    private function updateValidator(Request $request)
    {

        return Validator::make($request->all(), [
            "firstname" => "required|string",
            "lastname" => "required|string",
            "email" => "required|email",
            "phone" => "required|numeric",
            "blood_group" => "required|ends_with:+,-",
            "location" => "required|string",
        ]);
    }
    public function getUsers()
    {

        $users = Blood::all();
        if ($users) {
            return response()->json($users);
        } else {
            return response()->json([
                "message" => "Users are  not Available."
            ]);
        }
    }



    public function getSingleUser($id)
    {
        if (Blood::where('id', $id)->exists()) {
            $user = Blood::where('id', $id)->get();
            return  response()->json($user);
        } else {
            return response()->json([
                "message" => "User not found"
            ]);
        }
    }

    public function createUser(Request $request)
    {
        $validator = $this->createValidator($request);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $user = new Blood;
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->blood_group = $request->blood_group;
        $user->location = $request->location;
        $user->save();

        return response()->json(["message" => "User  has been Added"]);
    }

    public function deleteUser($id)
    {
        if (Blood::where('id', $id)->exists()) {
            $user = Blood::find($id);
            $user->delete();

            return response()->json([
                "message" => "user record deleted"
            ]);
        } else {
            return response()->json([
                "message" => "User not found"
            ]);
        }
    }

    public function updateUser(Request $request, $id)
    {
        if (Blood::where('id', $id)->exists()) {
            $validator = $this->updateValidator($request);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }
            $user = Blood::find($id);
            $user->firstname = is_null($request->firstname) ? $user->firstname : $request->firstname;
            $user->lastname = is_null($request->lastname) ? $user->lastname : $request->lastname;
            $user->email = is_null($request->email) ? $user->email : $request->email;
            $user->phone = is_null($request->phone) ? $user->phone : $request->phone;
            $user->blood_group = is_null($request->blood_group) ? $user->blood_group : $request->blood_group;
            $user->location = is_null($request->location) ? $user->location : $request->location;

            $user->save();

            return response()->json([
                "message" => "User Record Updated Successfully"
            ], 200);
        } else {
            return response()->json([
                "message" => "User not Exist, Try another ID."
            ], 404);
        }
    }
}
