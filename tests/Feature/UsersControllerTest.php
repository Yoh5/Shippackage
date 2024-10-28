<?php

namespace Tests\Unit;

use App\Http\Controllers\UsersController;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UsersControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_store_method_creates_user()
    {
        $controller = new UsersController();
        $request = new Request([
            "name" => "John",
            "surname" => "Doe",
            "email" => "john@example.com",
            "PhoneNumber" => "123456789",
            "password" => "password",
        ]);

        $response = $controller->store($request);

        $this->assertEquals(201, $response->getStatusCode());

        $user = User::where('email', 'john@example.com')->first();
        $this->assertNotNull($user);
        $this->assertEquals("John", $user->name);
    }

    public function test_get_All_Users_method_returns_all_users()
    {
        User::factory(5)->create();

        $controller = new UsersController();
        $response = $controller->get_All_Users();

        $this->assertEquals(201, $response->getStatusCode());
        $this->assertCount(5, json_decode($response->getContent(), true));
    }

    public function test_get_User_method_returns_user_by_id()
    {
        $user = User::factory()->create();

        $controller = new UsersController();
        $response = $controller->get_User($user->id);

        $this->assertEquals(201, $response->getStatusCode());
        $this->assertEquals($user->toArray(), json_decode($response->getContent(), true));
    }

    public function test_update_user()
    {
        $user = User::factory()->create();

        $controller = new UsersController();
        $request = new Request([
            'name' => 'Updated Name',
            'surname' => 'Updated Surname',
            'email' => 'updated@example.com',
            'PhoneNumber' => '987654321',
            'password' => 'updated_password',
        ]);

        $controller->update($request, $user->id);

        $updatedUser = User::find($user->id);
        $this->assertEquals('Updated Name', $updatedUser->name);
        $this->assertEquals('Updated Surname', $updatedUser->surname);
        $this->assertEquals('updated@example.com', $updatedUser->email);
        $this->assertEquals('987654321', $updatedUser->PhoneNumber);
        $this->assertTrue(Hash::check('updated_password', $updatedUser->password));
    }

    public function test_destroy_user()
    {
        $user = User::factory()->create();

        $controller = new UsersController();
        $controller->destroy($user->id);

        $deletedUser = User::find($user->id);
        $this->assertNull($deletedUser);
    }
}
