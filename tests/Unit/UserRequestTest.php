<?php

namespace Tests\Feature;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Validator;

class UserRequestTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * Teste une demande valide qui réussit la validation.
     *
     * @return void
     */
    public function test_valid_request_passes_validation()
    {
        $request = new UserRequest();

        $validator = Validator::make([
            'name' => $this->faker->firstName,
            'surname' => $this->faker->lastName,
            'compagny' => $this->faker->company,
            'email' => $this->faker->unique()->safeEmail,
            'password' => 'Password1!',
            'street_number' => $this->faker->buildingNumber,
            'street_name' => $this->faker->streetName,
            'postal_code' => $this->faker->postcode,
            'city' => $this->faker->city,
            'country' => $this->faker->country,
            'phone_number' => $this->faker->phoneNumber,
            'rgpd_consent' => true,
        ], $request->rules());

        $this->assertTrue($validator->passes());

        // Vérifier la création d'un utilisateur après validation réussie
        $user = User::create($validator->validated());

        $this->assertNotNull($user);
        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals($validator->validated()['email'], $user->email);
        // Ajoutez d'autres assertions selon vos besoins pour vérifier la création correcte de l'utilisateur
    }

    /**
     * Teste une demande invalide qui échoue la validation.
     *
     * @return void
     */
    public function test_invalid_request_fails_validation()
    {
        $request = new UserRequest();

        $validator = Validator::make([
            'name' => '', // empty name should fail validation
            'surname' => $this->faker->lastName,
            'compagny' => $this->faker->company,
            'email' => 'invalid-email', // invalid email should fail validation
            'password' => 'password', // password without required characters should fail
            'street_number' => $this->faker->buildingNumber,
            'street_name' => $this->faker->streetName,
            'postal_code' => '', // empty postal code should fail validation
            'city' => $this->faker->city,
            'country' => $this->faker->country,
            'phone_number' => $this->faker->phoneNumber,
            'rgpd_consent' => false, // consent not accepted should fail
        ], $request->rules());

        $this->assertFalse($validator->passes());
        $this->assertTrue($validator->errors()->has('name'));
        $this->assertTrue($validator->errors()->has('email'));
        $this->assertTrue($validator->errors()->has('password'));
        $this->assertTrue($validator->errors()->has('postal_code'));
        $this->assertTrue($validator->errors()->has('rgpd_consent'));
    }
}
