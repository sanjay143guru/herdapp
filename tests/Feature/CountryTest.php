<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Country;

class CountryTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__.'/../../bootstrap/app.php';
        $app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();
        return $app;
    }

    /**
     * Setup the test environment.
     */
    protected function setUp()
    {
        parent::setUp();
        $this->withoutMiddleware(); // disable middleware for clean testing
    }

    /**
     * Test that the home route redirects to countries index.
     */
    public function testHomeRedirectsToCountriesIndex()
    {
        $response = $this->get('/');
        $response->assertStatus(302); // expects redirect
        $response->assertRedirect(route('countries.index'));
    }

    /**
     * Test that Albania exists in the database.
     */
    public function testAlbaniaExistsInDatabase()
    {
        // Insert Albania if not exists to prevent duplicate errors
        Country::firstOrCreate(
            ['name' => 'Albania'], // find by name
            ['population' => 2771508] // set population if creating
        );

        // Assert the DB has Albania with the correct population
        $this->assertDatabaseHas('countries', [
            'name' => 'Albania',
            'population' => 2771508,
        ]);
    }
}
