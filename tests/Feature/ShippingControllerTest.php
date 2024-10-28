<?php

namespace Tests\Unit;

use App\Http\Controllers\ShippingController;
use App\Models\Shipping;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Tests\TestCase;

class ShippingControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_store_method_creates_shipping()
    {
        $controller = new ShippingController();
        $request = new Request([
            "package_id" => 1,
            "shippingType" => "boat",
            "company_id" => 1,
            "user_id" => 1,
            "origin_country_id" => 1,
            "destination_country_id" => 2,
        ]);

        $response = $controller->store($request);

        $this->assertEquals(201, $response->getStatusCode());
        $this->assertNotNull(Shipping::where('shippingType', 'boat')->first());
    }

    public function test_get_All_Shippings_method_returns_all_shippings()
    {
        Shipping::factory(5)->create();

        $controller = new ShippingController();
        $response = $controller->get_All_Shippings();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertCount(5, json_decode($response->getContent(), true));
    }

    public function test_get_Shipping_method_returns_shipping_by_id()
    {
        $shipping = Shipping::factory()->create();

        $controller = new ShippingController();
        $response = $controller->get_Shipping($shipping->id);

        $this->assertEquals(201, $response->getStatusCode());
    }

    public function test_update_shipping()
    {
        $shipping = Shipping::factory()->create();

        $controller = new ShippingController();
        $request = new Request([
            'package_id' => 2,
            'shippingType' => 'airplane',
            'company_id' => 2,
            'user_id' => 2,
            'origin_country_id' => 2,
            'destination_country_id' => 3,
        ]);

        $controller->update($request, $shipping->id);

        $updatedShipping = Shipping::find($shipping->id);
        $this->assertEquals(2, $updatedShipping->package_id);
        $this->assertEquals('airplane', $updatedShipping->shippingType);
    }

    public function test_delete_shipping()
    {
        $shipping = Shipping::factory()->create();

        $controller = new ShippingController();
        $controller->destroy($shipping->id);

        $this->assertDatabaseMissing('shippings', ['id' => $shipping->id]);
    }
}
