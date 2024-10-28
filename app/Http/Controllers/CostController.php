<?php

namespace App\Http\Controllers;

use App\Models\Cost;
use Illuminate\Http\Request;

class CostController extends Controller
{
    public function store(Request $request)
    {
        $donne = $request->validate([
            "cost" => ["required", "float"],
            "shippingId" => ["required", "unsignedBigInteger", "unique:costs"],
            "status" => ["required", "boolean"]
        ]);

        $cost = Cost::create([
            "cost" => $donne["cost"],
            "shippingId" => $donne["shippingId"],
            "status" => $donne["status"]
        ]);

        return response($user, 201);
    }

    public function get_All_Costs()
    {
        $costs = Cost::all();

        return response($costs, 201);
    }

    public function get_Cost($cost_id)
    {
        $cost = Cost::find($cost_id);

        return response($cost, 201);
    }

    public function update(Request $request, $cost_id)
    {
        $cost = Cost::find($cost_id);

        if ($cost) {
            $cost->update([
                'cost' => $request->input('cost'),
                'shippingId' => $request->input('shippingId'),
                'status' => $request->input('status')
            ]);
            return response(["message" => "Utilisateur mis à jour avec succès"], 201);
        }
    }

    public function destroy($cost_id)
    {
        $cost = Cost::find($cost_id);

        if ($cost) {
            $cost->delete();
            return response(["message" => "Utilisateur supprime avec succès"], 201);
        } else {
            return response(["message" => "Utilisateur non trouve"], 401);
        }
    }
}
