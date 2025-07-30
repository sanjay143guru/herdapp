<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CountryTest extends TestCase
{
    use DatabaseTransactions;

    protected function setUp()
    {
        parent::setUp();
        $this->withoutMiddleware();
    }

    public function testBasicTest()
    {
        $response = $this->get('/');
        $response->assertStatus(302);
    }

    public function test_albania_exists()
    {
        $this->assertDatabaseHas('countries', [
            'name' => 'Albania',
            'population' => 3000000 // rounded population as per update
        ]);
    }
}
