<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AccountTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_reset_the_application()
    {
        $response = $this->post('/reset');
        $response->assertStatus(200)->assertContent('OK');
    }
}
