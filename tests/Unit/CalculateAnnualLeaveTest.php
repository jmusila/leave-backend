<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;

uses(Tests\TestCase::class);

$data = [
    "job_start_date" =>  "2021/11/16",
    "days_taken_before" => 10
];


it('should return 422 if job start date is missing', function () {
    $response = $this->getJson('api/annual-leave?' . http_build_query(['days_taken_before' => 10]));

    $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
});

it('should calculate leave balance successfully', function () use ($data) {
    $response = $this->getJson('api/annual-leave?' . http_build_query($data));

    $response->assertStatus(Response::HTTP_OK);
});
