<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Tests\TestCase;
use App\Mail\SendRegistrationEmail;

class RegisteredUserControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_register_and_rgpd_consent_is_set()
    {
        Mail::fake();
        Event::fake();

        $userDetails = [
            'name' => 'John',
            'surname' => 'Doe',
            'compagny' => 'Doe Inc.',
            'email' => 'johndoe@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'street_number' => '123',
            'street_name' => 'Main St',
            'postal_code' => '12345',
            'city' => 'Anytown',
            'country' => 'Country',
            'phone_number' => '1234567890',
            'rgpd_consent' => true,
        ];

        $response = $this->post('/register', $userDetails);

        $this->assertDatabaseHas('users', [
            'email' => 'johndoe@example.com',
            'rgpd_consent' => true,
        ]);

        Event::assertDispatched(Registered::class);

        $response->assertRedirect('/verification/notice');
    }

    public function test_professional_user_triggers_email()
    {
        Mail::fake();
        Event::fake();

        $userDetails = [
            'name' => 'Jane',
            'surname' => 'Doe',
            'compagny' => 'Doe Inc.',
            'email' => 'janedoe@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'street_number' => '123',
            'street_name' => 'Main St',
            'postal_code' => '12345',
            'city' => 'Anytown',
            'country' => 'Country',
            'phone_number' => '1234567890',
            'rgpd_consent' => true,
            'professional' => true,
        ];

        $response = $this->post('/register', $userDetails);

        Mail::assertSent(SendRegistrationEmail::class, function ($mail) {
            return $mail->hasTo(env('CONTACT_EMAIL'));
        });

        $this->assertDatabaseHas('users', [
            'email' => 'janedoe@example.com',
            'rgpd_consent' => true,
        ]);

        Event::assertDispatched(Registered::class);

        $response->assertRedirect('/verification/notice');
    }
}
