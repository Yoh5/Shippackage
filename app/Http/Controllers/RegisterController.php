<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function register(Request $request) {
        $donne = $request->validate([
            "name" => ["required", "string"],
            "surname" => ["required", "string"],
            "email" => ["required", "email", "unique:users"],
            "PhoneNumber" => ["required", "string"],
            "sexe" => ["required", "string"],
            "pays" => ["required", "string"],
            "date_naissance" => ["required", "date"],
            "password" => ["required", "string"]
        ]);
        $user = User::create([
            "name" => $donne["name"],
            "surname" => $donne["surname"],
            "email" => $donne["email"],
            "PhoneNumber" => $donne["PhoneNumber"],
            "sexe" => $donne["sexe"],
            "pays" => $donne["pays"],
            "date_naissance" => $donne["date_naissance"],
            "password" => bcrypt($donne["password"])
        ]);
        return response($user, 201);
    }
}
