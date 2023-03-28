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

    $response->assertJson(['message' => 'The job start date field is required.']);
});

it('should return 422 if days taken before is missing', function () {
    $response = $this->getJson('api/annual-leave?' . http_build_query(['job_start_date' => "2021/11/16"]));

    $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

    $response->assertJson(['message' => 'The days taken before field is required.']);
});

it('should calculate leave balance successfully', function () use ($data) {
    $response = $this->getJson('api/annual-leave?' . http_build_query($data));

    $response->assertStatus(Response::HTTP_OK);
});
