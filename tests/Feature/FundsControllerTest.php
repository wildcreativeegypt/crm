<?php

namespace Tests\Feature;

use App\Models\FacebookAccount;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FundsControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_add_funds_with_valid_input()
    {
        // Create a test Facebook account
        $facebookAccount = FacebookAccount::factory()->create();

        // Send a POST request to add funds
        $response = $this->postJson("/api/facebook-accounts/{$facebookAccount->id}/add-funds", [
            'funds_added' => 2000,
        ]);

        // Assert the response status and structure
        $response->assertStatus(200)
            ->assertJson([
                'message' => 'Funds added successfully.',
                'funds_added' => 2000,
                'net_amount' => 1754.39, // Rounded result
            ]);

        // Assert the database has the correct values
        $this->assertDatabaseHas('facebook_accounts', [
            'id' => $facebookAccount->id,
            'funds_added' => 2000,
            'net_amount' => 1754.39,
        ]);
    }

    public function test_add_funds_with_zero_input()
    {
        $facebookAccount = FacebookAccount::factory()->create();

        $response = $this->postJson("/api/facebook-accounts/{$facebookAccount->id}/add-funds", [
            'funds_added' => 0,
        ]);

        $response->assertStatus(200)
            ->assertJson([
                'message' => 'Funds added successfully.',
                'funds_added' => 0,
                'net_amount' => 0,
            ]);
    }

    public function test_add_funds_with_negative_input()
    {
        $facebookAccount = FacebookAccount::factory()->create();

        $response = $this->postJson("/api/facebook-accounts/{$facebookAccount->id}/add-funds", [
            'funds_added' => -500,
        ]);

        $response->assertStatus(422); // Validation error
    }
}