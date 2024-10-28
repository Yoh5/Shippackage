<?php

namespace Tests\Unit;

use App\Http\Controllers\CostController;
use App\Models\Cost;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Tests\TestCase;

class CostControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_store_method_creates_cost()
    {
        $controller = new CostController();
        $request = new Request([
            "cost" => 50.75,
            "shippingId" => 1,
            "status" => true
        ]);

        $response = $controller->store($request);

        $this->assertEquals(201, $response->getStatusCode());
    }

    public function test_get_All_Costs_method_returns_all_costs()
    {
        Cost::factory(5)->create();

        $controller = new CostController();
        $response = $controller->get_All_Costs();

        $this->assertEquals(201, $response->getStatusCode());
        $costs = json_decode($response->getContent(), true);

        $this->assertIsArray($costs);
        $this->assertCount(5, $costs);
    }

    public function test_get_Cost_method_returns_cost_by_id()
    {
        $cost = Cost::factory()->create();

        $controller = new CostController();
        $response = $controller->get_Cost($cost->id);

        $this->assertEquals(201, $response->getStatusCode());
    }

    public function test_update_cost()
    {
        $cost = Cost::factory()->create();

        $controller = new CostController();
        $request = new Request([
            'cost' => 60.0,
            'shippingId' => 2,
            'status' => false
        ]);

        $controller->update($request, $cost->id);

        $updatedCost = Cost::find($cost->id);
        $this->assertEquals(60.0, $updatedCost->cost);
        $this->assertEquals(2, $updatedCost->shippingId);
    }

    public function test_delete_cost()
    {
        $cost = Cost::factory()->create();

        $controller = new CostController();
        $response = $controller->destroy($cost->id);

        $this->assertEquals(201, $response->getStatusCode());
    }
}
