<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(Request $request) {
        $data = $request->validate([
            "identity" => ["required", "string"], // Utiliser "identity" pour le champ e-mail ou numéro de téléphone
            "password" => ["required", "string"]
        ]);

        // Utiliser une clause OR pour rechercher soit par e-mail, soit par numéro de téléphone
        $user = User::where("email", $data["identity"])
                    ->orWhere("PhoneNumber", $data["identity"])
                    ->first();

        if (!$user || !Hash::check($data["password"], $user->password)) {
            // Si l'utilisateur n'est pas trouvé ou le mot de passe est incorrect
            return response(["message" => "Identifiants invalides"], 401);
        }

        // Génération du jeton Sanctum
        $token = $user->createToken("CLE_SECRETE")->plainTextToken;
        return response([
            "user" => $user,
            "token" => $token
        ]);
    }
}

  