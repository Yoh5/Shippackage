<?php

namespace Tests\Unit;

use App\Http\Controllers\PackageController;
use App\Models\Package;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Tests\TestCase;

class PackageControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_store_method_creates_package()
    {
        $controller = new PackageController();
        $request = new Request([
            "trackingNumber" => "ABC123",
            "weight" => 10.5,
            "height" => 20,
            "width" => 15,
            "length" => 30,
            "value" => 100,
            "type" => "express",
            "arrivalDate" => now(),
        ]);

        $response = $controller->store($request);

        $this->assertEquals(201, $response->getStatusCode());
    }

    public function test_get_All_Packages_method_returns_all_packages()
    {
        Package::factory(5)->create();

        $controller = new PackageController();
        $response = $controller->get_All_Packages();

        $this->assertEquals(201, $response->getStatusCode());
        $this->assertCount(5, json_decode($response->getContent(), true));
    }

    public function test_get_Package_method_returns_package_by_id()
    {
        $package = Package::factory()->create();

        $controller = new PackageController();
        $response = $controller->get_Package($package->id);

        $this->assertEquals(201, $response->getStatusCode());
    }

    public function test_update_package()
    {
        $package = Package::factory()->create();

        $controller = new PackageController();
        $request = new Request([
            'trackingNumber' => "UpdatedABC123",
            'weight' => 15.0,
            'height' => 25.0,
            'width' => 18.0,
            'length' => 35.0,
            'value' => 150.0,
            'type' => 'normal',
            'arrivalDate' => '2023-11-10',
        ]);

        $controller->update($request, $package->id);

        $updatedPackage = Package::find($package->id);
        $this->assertEquals(15.0, $updatedPackage->weight);
    }

    public function test_delete_package()
    {
        $package = Package::factory()->create();

        $controller = new PackageController();
        $controller->destroy($package->id);

        $this->assertDatabaseMissing('packages', ['id' => $package->id]);
    }
}
