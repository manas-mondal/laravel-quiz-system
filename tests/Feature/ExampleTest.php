<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Category; // for Factory use

class ExampleTest extends TestCase
{
    use RefreshDatabase; // this trait automatically migrate in test database

    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        // Step: create category by using Factory
        Category::factory()->create();

        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
