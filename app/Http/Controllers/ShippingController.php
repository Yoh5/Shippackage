<?php

namespace App\Http\Controllers;

use App\Models\Shipping;
use Illuminate\Http\Request;

class ShippingController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            "package_id" => ["required", "exists:packages,id"],
            "shippingType" => ["required", "in:boat,airplane,vehicule"],
            "company_id" => ["required", "exists:companies,id"],
            "user_id" => ["required", "exists:users,id"],
            "origin_country_id" => ["required", "exists:origin_countries,id"],
            "destination_country_id" => ["required", "exists:destination_countries,id"],
        ]);

        $shipping = Shipping::create($data);

        return response($shipping, 201);
    }

    public function get_All_Shippings()
    {
        $shippings = Shipping::all();

        return response($shippings, 200);
    }

    public function get_Shipping($shipping_id)
    {
        $shipping = Shipping::find($shipping_id);

        return response($shipping, $shipping ? 200 : 404);
    }

    public function update(Request $request, $shipping_id)
    {
        $shipping = Shipping::find($shipping_id);

        if ($shipping) {
            $data = $request->validate([
                "package_id" => ["sometimes", "exists:packages,id"],
                "shippingType" => ["sometimes", "in:boat,airplane,vehicule"],
                "company_id" => ["sometimes", "exists:companies,id"],
                "user_id" => ["sometimes", "exists:users,id"],
                "origin_country_id" => ["sometimes", "exists:origin_countries,id"],
                "destination_country_id" => ["sometimes", "exists:destination_countries,id"],
            ]);

            $shipping->update($data);

            return response(["message" => "Shipping mis à jour avec succès"], 200);
        } else {
            return response(["message" => "Shipping non trouvé"], 404);
        }
    }

    public function destroy($shipping_id)
    {
        $shipping = Shipping::find($shipping_id);

        if ($shipping) {
            $shipping->delete();
            return response(["message" => "Shipping supprimé avec succès"], 200);
        } else {
            return response(["message" => "Shipping non trouvé"], 404);
        }
    }
}
