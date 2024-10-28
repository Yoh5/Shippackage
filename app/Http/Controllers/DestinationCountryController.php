<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DestinationCountry;

class DestinationCountryController extends Controller
{
    public function store(Request $request)
    {
        $donne = $request->validate([
            "country" => ["required", "string"],
            "address" => ["required", "string"],
            "email" => ["required", "email", "unique:users"],
            "PhoneNumber" => ["required", "string"],
        ]);

        $DestinationCountry = DestinationCountry::create([
            "country" => $donne["country"],
            "address" => $donne["address"],
            "email" => $donne["email"],
            "PhoneNumber" => $donne["PhoneNUmber"],
        ]);

        return response($DestinationCountry, 201);
    }

    public function get_All_DestinationCountries()
    {
        $DestinationCountries = DestinationCountry::all();

        return response($DestinationCountries, 201);
    }

    public function get_DestinationCountry($DestinationCountry_id)
    {
        $DestinationCountry = DestinationCountry::find($DestinationCountry_id);

        return response($DestinationCountry, 201);
    }

    public function update(Request $request, $DestinationCountry_id)
    {
        $DestinationCountry = DestinationCountry::find($DestinationCountry_id);

        if ($DestinationCountry) {
            $DestinationCountry->update([
                'country' => $request->input('country'),
                'address' => $request->input('address'),
                'email' => $request->input('email'),
                'PhoneNumber' => $request->input('PhoneNumber')
            ]);
            return response(["message" => "Utilisateur mis à jour avec succès"], 201);
        }
    }

    public function destroy($DestinationCountry_id)
    {
        $DestinationCountry = DestinationCountry::find($DestinationCountry_id);

        if ($DestinationCountry) {
            $DestinationCountry->delete();
            return response(["message" => "Utilisateur supprime avec succès"], 201);
        } else {
            return response(["message" => "Utilisateur non trouve"], 401);
        }
    }
}
