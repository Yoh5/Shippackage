<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function store(Request $request)
    {
        $donne = $request->validate([
            "name" => ["required", "string"],
            "surname" => ["required", "string"],
            "email" => ["required", "email", "unique:users"],
            "PhoneNumber" => ["required", "string"],
            "password" => ["required", "string"]
        ]);

        $user = User::create([
            "name" => $donne["name"],
            "surname" => $donne["surname"],
            "email" => $donne["email"],
            "PhoneNumber" => $donne["PhoneNumber"],
            "password" => bcrypt($donne["password"])
        ]);

        return response($user, 201);
    }

    public function get_All_Users()
    {
        $users = User::all();

        return response($users, 201);
    }

    public function get_User($user_id)
    {
        $user = User::find($user_id);

        return response($user, 201);
    }

    public function update(Request $request, $user_id)
    {
        $user = User::find($user_id);

        if ($user) {
            $user->update([
                'name' => $request->input('name'),
                'surname' => $request->input('surname'),
                'email' => $request->input('email'),
                'PhoneNumber' => $request->input('PhoneNumber'),
                'password' => bcrypt($request->input('password')),
            ]);
            return response(["message" => "Utilisateur mis à jour avec succès"], 201);
        }
    }

    public function destroy($user_id)
    {
        $user = User::find($user_id);

        if ($user) {
            $user->delete();
            return response(["message" => "Utilisateur supprime avec succès"], 201);
        } else {
            return response(["message" => "Utilisateur non trouve"], 401);
        }
    }
}
