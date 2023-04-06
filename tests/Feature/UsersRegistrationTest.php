<?php

use App\Notifications\Auth\VerifyEmail;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Notification;
use Illuminate\Testing\Fluent\AssertableJson;

uses(Illuminate\Foundation\Testing\WithFaker::class);
uses(Illuminate\Foundation\Testing\DatabaseTransactions::class);


it('should create a new user successfully', function () {
    Notification::fake();
    $userData = [
        "email" =>  $this->faker->unique()->safeEmail(),
        "password" => "password",
        "password_confirmation" => "password",
        "first_name" => "John",
        "middle_name" => "Test",
        "last_name" => "Doe",
        "phone_number" => $this->faker->unique()->e164PhoneNumber()
    ];
    $response = $this->postJson('api/create-user', $userData);

    $response->assertStatus(Response::HTTP_CREATED);

    $response->assertJson(fn (AssertableJson $json) => $json->where("data.email", $userData["email"]));

    Notification::assertSentToTimes(1, VerifyEmail::class);
});
