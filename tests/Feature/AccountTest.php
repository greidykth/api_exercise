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
        $response = $this->get('/balance?account_id=1234');
        $response->assertStatus(404)->assertContent('0');
    }

    /**
     * Test for create account with initial balance
     *
     * @return void
     */
    public function test_create_account_with_initial_balance()
    {
        $response = $this->post('/event', ["type"=>"deposit", "destination"=>"100", "amount"=>10]);
        $response->assertStatus(201)->assertJson(["destination"=> ["id"=>"100", "balance"=>10]]);
    }

    /**
     * Test for deposit into existing account
     *
     * @return void
     */
    public function test_deposit_into_existing_account()
    {
        $response = $this->post('/event', ["type"=>"deposit", "destination"=>"100", "amount"=>10]);
        $response->assertStatus(201)->assertJson(["destination"=> ["id"=>"100", "balance"=>20]]);
    }

    /**
     * Test for get balance for existing account.
     *
     * @return void
     */
    public function test_get_balance_for_existing_account()
    {
        $response = $this->get('/balance?account_id=100');
        $response->assertStatus(200)->assertContent('20');
    }

     /**
     * Test for withdraw from non-existing account
     *
     * @return void
     */
    public function test_withdraw_from_non_existing_account()
    {
        $response = $this->post('/event', ["type"=>"withdraw", "origin"=>"200", "amount"=>"10"]);
        $response->assertStatus(404)->assertContent('0');
    }

    /**
     * Test for withdraw from existing account
     *
     * @return void
     */
    public function test_withdraw_from_existing_account()
    {
        $response = $this->post('/event', ["type"=>"withdraw", "origin"=>"100", "amount"=>5]);
        $response->assertStatus(201)->assertJson(["origin"=> ["id"=>"100", "balance"=>15]]);
    }
}
