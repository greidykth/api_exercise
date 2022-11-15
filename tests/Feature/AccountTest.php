<?php

namespace Tests\Feature;

use Tests\TestCase;

class AccountTest extends TestCase
{
    /**
     * A reset application test.
     *
     * @return void
     */
    public function test_reset_the_application()
    {
        $response = $this->post('/reset');
        $response->assertStatus(200)->assertContent('OK');
    }
    /**
     * Test for get balance for non-existing account.
     *
     * @return void
     */
    public function test_get_balance_for_non_existing_account()
    {
        $response = $this->get('/balance');
        $response->assertStatus(404)->assertContent('0');
    }
}
