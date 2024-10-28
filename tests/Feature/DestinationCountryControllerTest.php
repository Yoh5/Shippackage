<?php

namespace Tests\Unit;

use App\Http\Controllers\DestinationCountryController;
use App\Models\DestinationCountry;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Tests\TestCase;

class DestinationCountryControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_store_method_creates_destination_country()
    {
        $controller = new DestinationCountryController();
        $request = new Request([
            "country" => "CountryName",
            "address" => "CountryAddress",
            "email" => "country@example.com",
            "PhoneNumber" => "123456789",
        ]);

        $response = $controller->store($request);

        $this->assertEquals(201, $response->getStatusCode());
        $this->assertNotNull(DestinationCountry::where('email', 'country@example.com')->first());
    }

    public function test_get_All_DestinationCountries_method_returns_all_destination_countries()
    {
        DestinationCountry::factory(5)->create();

        $controller = new DestinationCountryController();
        $response = $controller->get_All_DestinationCountries();

        $this->assertEquals(201, $response->getStatusCode());
        $this->assertCount(5, json_decode($response->getContent(), true));
    }

    public function test_get_DestinationCountry_method_returns_destination_country_by_id()
    {
        $destinationCountry = DestinationCountry::factory()->create();

        $controller = new DestinationCountryController();
        $response = $controller->get_DestinationCountry($destinationCountry->id);

        $this->assertEquals(201, $response->getStatusCode());
    }

    public function test_update_destination_country()
    {
        $destinationCountry = DestinationCountry::factory()->create();

        $controller = new DestinationCountryController();
        $request = new Request([
            'country' => "UpdatedCountryName",
            'address' => "UpdatedCountryAddress",
            'email' => "updated_country@example.com",
            'PhoneNumber' => "987654321",
        ]);

        $controller->update($request, $destinationCountry->id);

        $updatedDestinationCountry = DestinationCountry::find($destinationCountry->id);
        $this->assertEquals('UpdatedCountryName', $updatedDestinationCountry->country);
        $this->assertEquals('updated_country@example.com', $updatedDestinationCountry->email);
    }

    public function test_delete_destination_country()
    {
        $destinationCountry = DestinationCountry::factory()->create();

        $controller = new DestinationCountryController();
        $controller->destroy($destinationCountry->id);

        $this->assertDatabaseMissing('destination_countries', ['id' => $destinationCountry->id]);
    }
}
