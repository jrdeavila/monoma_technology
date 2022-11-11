<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthUserTest extends TestCase
{

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_login_successfull()
    {

        $response = $this->post(route('login'), [
            'username' => 'tester',
            'password' => 'PASSWORD'
        ]);

        $response->assertJsonStructure(
            [
                'meta' => [
                    'success',
                    'errors',
                ],
                'data' => [
                    'token',
                    'minutes_to_expire',
                ],
            ]
        );

        $response->assertStatus(200);
    }
    public function test_login_password_invalid()
    {

        $response = $this->post(route('login'), [
            'username' => 'tester',
            'password' => 'xxxxxx'
        ]);

        $response->assertJsonStructure(
            [
                'meta' => [
                    'success',
                    'errors' => [
                        0,
                    ],
                ],

            ]
        );

        $response->assertStatus(401);
    }


    public function test_login_without_body()
    {

        $response = $this->post(route('login'));

        $response->assertJsonStructure(
            [
                'meta' => [
                    'success',
                    'errors'
                ],

            ]
        );

        $response->assertStatus(422);
    }
}
