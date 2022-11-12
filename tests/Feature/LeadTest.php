<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Src\Shared\Models\MongoUser;
use Tests\TestCase;
use Tymon\JWTAuth\Facades\JWTAuth;

class LeadTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_get_leads_without_token()
    {
        $response = $this->get(route('lead.index'));
        $response->assertStatus(401);
    }

    public function test_get_leads_with_invalid_token()
    {
        $response = $this->get(route('lead.index'));
        $response->header('Authorization', 'Bearer invalid_token');
        $response->assertStatus(401);
    }

    public function test_get_leads_with_expired_token()
    {
        $response = $this->get(route('lead.index'));
        $response->header('Authorization', 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0L2F1dGgiLCJpYXQiOjE2NjgxODkzNjQsImV4cCI6MTY2ODE4OTQyNCwibmJmIjoxNjY4MTg5MzY0LCJqdGkiOiJEa01Hc0p3amZpbjlGdEZzIiwic3ViIjoiNjM2ZThhNjlhYzcxNTM4Y2UwMGY2Njk0IiwicHJ2IjoiNjVjNmJjMzIzZDYwNTQ1ZGRkMWVmMjY5Nzk3MmU5MGI0MWUyNTgyMyJ9.XAxJA14Q5LcJVyQnyROIPunoqwwqAGnS_5TMRExS0cM');
        $response->assertStatus(401);
    }
}
