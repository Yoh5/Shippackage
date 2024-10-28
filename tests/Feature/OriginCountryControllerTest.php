<?php

namespace Tests\Unit;

use App\Http\Controllers\OriginCountryController;
use App\Models\OriginCountry;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Tests\TestCase;

class OriginCountryControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_store_method_creates_origin_country()
    {
        $controller = new OriginCountryController();
        $request = new Request([
            "country" => "CountryName",
            "address" => "CountryAddress",
            "email" => "country@example.com",
            "PhoneNumber" => "123456789",
        ]);

        $response = $controller->store($request);

        $this->assertEquals(201, $response->getStatusCode());
        $this->assertNotNull(OriginCountry::where('email', 'country@example.com')->first());
    }

    public function test_get_All_OriginCountries_method_returns_all_origin_countries()
    {
        OriginCountry::factory(5)->create();

        $controller = new OriginCountryController();
        $response = $controller->get_All_OriginCountries();

        $this->assertEquals(201, $response->getStatusCode());
        $this->assertCount(5, json_decode($response->getContent(), true));
    }

    public function test_get_OriginCountry_method_returns_origin_country_by_id()
    {
        $originCountry = OriginCountry::factory()->create();

        $controller = new OriginCountryController();
        $response = $controller->get_OriginCountry($originCountry->id);

        $this->assertEquals(201, $response->getStatusCode());
    }

    public function test_update_origin_country()
    {
        $originCountry = OriginCountry::factory()->create();

        $controller = new OriginCountryController();
        $request = new Request([
            'country' => "UpdatedCountryName",
            'address' => "UpdatedCountryAddress",
            'email' => "updated_country@example.com",
            'PhoneNumber' => "987654321",
        ]);

        $controller->update($request, $originCountry->id);

        $updatedOriginCountry = OriginCountry::find($originCountry->id);
        $this->assertEquals('UpdatedCountryName', $updatedOriginCountry->country);
        $this->assertEquals('updated_country@example.com', $updatedOriginCountry->email);
    }

    public function test_delete_origin_country()
    {
        $originCountry = OriginCountry::factory()->create();

        $controller = new OriginCountryController();
        $controller->destroy($originCountry->id);

        $this->assertDatabaseMissing('origin_countries', ['id' => $originCountry->id]);
    }
}
