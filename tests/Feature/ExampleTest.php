<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertSee('Documentation');

        $response->assertSeeTextInOrder(['Documentation', 'Laracast']);

        $response->assertOk();
    }

    public function test_the_about_route_returns_a_successful_response(): void
    {
        $response = $this->get('/about');

        $response->assertSee('About Page');

        $response->assertOk();
    }
}
