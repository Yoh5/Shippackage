<?php

namespace Tests\Unit;

use App\Http\Controllers\CompanyController;
use App\Models\Company;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Tests\TestCase;

class CompanyControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_store_method_creates_company()
    {
        $controller = new CompanyController();
        $request = new Request([
            "name" => "ACME Corp",
            "contacts" => "123 Main St",
        ]);

        $response = $controller->store($request);

        $this->assertEquals(201, $response->getStatusCode());

        $company = Company::where('name', 'ACME Corp')->first();
        $this->assertNotNull($company);
        $this->assertEquals("ACME Corp", $company->name);
    }

    public function test_get_All_Company_method_returns_all_companies()
    {
        Company::factory(5)->create();

        $controller = new CompanyController();
        $response = $controller->get_All_Company();

        $this->assertEquals(201, $response->getStatusCode());
    }

    public function test_get_Company_method_returns_company_by_id()
    {
        $company = Company::factory()->create();

        $controller = new CompanyController();
        $response = $controller->get_Company($company->id);

        $this->assertEquals(201, $response->getStatusCode());
    }

    public function test_update_company()
    {
        $company = Company::factory()->create();

        $controller = new CompanyController();
        $request = new Request([
            'name' => 'Updated Company',
            'contacts' => 'Updated Contacts',
        ]);

        $controller->update($request, $company->id);

        $updatedCompany = Company::find($company->id);
        $this->assertEquals('Updated Company', $updatedCompany->name);
        $this->assertEquals('Updated Contacts', $updatedCompany->contacts);
    }

    public function test_delete_company()
    {
        $company = Company::factory()->create();

        $controller = new CompanyController();
        $controller->destroy($company->id);

        $this->assertDatabaseMissing('companies', ['id' => $company->id]);
    }
}
