<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function store(Request $request)
    {
        $donne = $request->validate([
            "name" => ["required", "string"],
            "contacts" => ["required", "string"]
        ]);

        $company = Company::create([
            "name" => $donne["name"],
            "contacts" => $donne["contacts"]
        ]);

        return response($company, 201);
    }

    public function get_All_Company()
    {
        $company = Company::all();

        return response($company, 201);
    }

    public function get_Company($company_id)
    {
        $company = Company::find($company_id);

        return response($company, 201);
    }

    public function update(Request $request, $company_id)
    {
        $company = Company::find($company_id);

        if ($company) {
            $company->update([
                'name' => $request->input('name'),
                'contacts' => $request->input('contacts'),
            ]);
            return response(["message" => "Company mis à jour avec succès"], 201);
        }
    }

    public function destroy($company_id)
    {
        $company = Company::find($company_id);

        if ($company) {
            $company->delete();
            return response(["message" => "Company supprime avec succès"], 201);
        } else {
            return response(["message" => "Company non trouve"], 401);
        }
    }
}
