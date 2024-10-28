<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            "trackingNumber" => ["required", "string"],
            "weight" => ["required", "numeric"],
            "height" => ["required", "numeric"],
            "width" => ["required", "numeric"],
            "length" => ["required", "numeric"],
            "value" => ["required", "numeric"],
            "type" => ["required", "in:express,normal"],
            "arrivalDate" => ["required", "date"],
        ]);

        $package = Package::create([
            "trackingNumber" => $data["trackingNumber"],
            "weight" => $data["weight"],
            "height" => $data["height"],
            "width" => $data["width"],
            "length" => $data["length"],
            "value" => $data["value"],
            "type" => $data["type"],
            "arrivalDate" => $data["arrivalDate"],
        ]);

        return response($package, 201);
    }

    public function get_All_Packages()
    {
        $package = Package::all();

        return response($package, 201);
    }

    public function get_Package($package_id)
    {
        $package = Package::find($package_id);

        return response($package, 201);
    }

    public function update(Request $request, $package_id)
    {
        $package = Package::find($package_id);

        if ($package) {
            $package->update([
                'trackingNumber' => $request->input('trackingNumber'),
                'weight' => $request->input('weight'),
                'height' => $request->input('height'),
                'width' => $request->input('width'),
                'length' => $request->input('length'),
                'value' => $request->input('value'),
                'type' => $request->input('type'),
                'arrivalDate' => $request->input('arrivalDate'),
            ]);
            return response(["message" => "Package mis à jour avec succès"], 201);
        }
    }

    public function destroy($package_id)
    {
        $package = Package::find($package_id);

        if ($package) {
            $package->delete();
            return response(["message" => "Package supprime avec succès"], 201);
        } else {
            return response(["message" => "Package non trouve"], 401);
        }
    }
}
