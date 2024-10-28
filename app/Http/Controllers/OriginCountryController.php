<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OriginCountry;

class OriginCountryController extends Controller
{
    public function store(Request $request)
    {
        $donne = $request->validate([
            "country" => ["required", "string"],
            "address" => ["required", "string"],
            "email" => ["required", "email", "unique:users"],
            "PhoneNumber" => ["required", "string"],
        ]);

        $OriginCountry = OriginCountry::create([
            "country" => $donne["country"],
            "address" => $donne["address"],
            "email" => $donne["email"],
            "PhoneNumber" => $donne["PhoneNUmber"],
        ]);

        return response($OriginCountry, 201);
    }

    public function get_All_OriginCountries()
    {
        $OriginCountries = OriginCountry::all();

        return response($OriginCountries, 201);
    }

    public function get_OriginCountry($OriginCountry_id)
    {
        $OriginCountry = OriginCountry::find($OriginCountry_id);

        return response($OriginCountry, 201);
    }

    public function update(Request $request, $OriginCountry_id)
    {
        $OriginCountry = OriginCountry::find($OriginCountry_id);

        if ($OriginCountry) {
            $OriginCountry->update([
                'country' => $request->input('country'),
                'address' => $request->input('address'),
                'email' => $request->input('email'),
                'PhoneNumber' => $request->input('PhoneNumber')
            ]);
            return response(["message" => "Utilisateur mis à jour avec succès"], 201);
        }
    }

    public function destroy($OriginCountry_id)
    {
        $OriginCountry = OriginCountry::find($OriginCountry_id);

        if ($OriginCountry) {
            $OriginCountry->delete();
            return response(["message" => "Utilisateur supprime avec succès"], 201);
        } else {
            return response(["message" => "Utilisateur non trouve"], 401);
        }
    }
}
