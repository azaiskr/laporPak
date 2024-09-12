<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Database\Seeders\DatabaseSeeder;
use App\Models\Report;
use Database\Seeders\ApiTestSeeder;

class ApiReportTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test listing reports successfully.
     *
     * @return void
     */

    // Contoh pengujian di tests/Feature/ApiReportTest.php

    public function testIndexReturnsReports(): void
    {
        $this->seed([DatabaseSeeder::class, ApiTestSeeder::class]);
        $apikey = hash('sha256', 'johndoeapikey');
        $response = $this->getJson('/api/reports?page=1&size=10', [
            'X-API-KEY' => $apikey,
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'title',
                        'category',
                        'description',
                        'media',
                        'latitude',
                        'longitude',
                        'address',
                        'up_rate',
                        'down_rate',
                        'status',
                        'created_at',
                        'updated_at',
                    ]
                ]
            ]);
    }


    /**
     * Test filtering reports by category.
     *
     * @return void
     */
    public function testIndexFiltersByCategory(): void
    {
        $this->seed([DatabaseSeeder::class, ApiTestSeeder::class]);
        $apikey = hash('sha256', 'johndoeapikey');
        $response = $this->getJson('/api/reports?filter=category', [
            'X-API-KEY' => $apikey,
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'title',
                        'category',
                        'description',
                        'media',
                        'latitude',
                        'longitude',
                        'address',
                        'up_rate',
                        'down_rate',
                        'status',
                        'created_at',
                        'updated_at',
                    ]
                ]
            ]);
    }

    /**
     * Test filtering reports by up_rate.
     *
     * @return void
     */
    public function testIndexFiltersByUpRate(): void
    {
        $this->seed([DatabaseSeeder::class, ApiTestSeeder::class]);
        $apikey = hash('sha256', 'johndoeapikey');
        $response = $this->getJson('/api/reports?filter=up_rate', [
            'X-API-KEY' => $apikey,
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'title',
                        'category',
                        'description',
                        'media',
                        'latitude',
                        'longitude',
                        'address',
                        'up_rate',
                        'down_rate',
                        'status',
                        'created_at',
                        'updated_at',
                    ]
                ]
            ]);
    }

    /**
     * Test filtering reports by down_rate.
     *
     * @return void
     */
    public function testIndexFiltersByDownRate(): void
    {
        $this->seed([DatabaseSeeder::class, ApiTestSeeder::class]);
        $apikey = hash('sha256', 'johndoeapikey');
        $response = $this->getJson('/api/reports?filter=down_rate', [
            'X-API-KEY' => $apikey,
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'title',
                        'category',
                        'description',
                        'media',
                        'latitude',
                        'longitude',
                        'address',
                        'up_rate',
                        'down_rate',
                        'status',
                        'created_at',
                        'updated_at',
                    ]
                ]
            ]);
    }

    /**
     * Test listing reports with invalid parameters.
     *
     * @return void
     */
    public function testIndexWithInvalidParameters(): void
    {
        $this->seed([DatabaseSeeder::class, ApiTestSeeder::class]);
        $apikey = hash('sha256', 'johndoeapikey');
        $response = $this->getJson('/api/reports?page=invalid&size=invalid', [
            'X-API-KEY' => $apikey,
        ]);

        $response->assertStatus(400)
            ->assertJson([
                'message' => 'Invalid parameters'
            ]);
    }

    /**
     * Test showing a report successfully.
     *
     * @return void
     */
    public function testShowReturnsReport(): void
    {
        $this->seed([DatabaseSeeder::class, ApiTestSeeder::class]);

        $report = Report::with('ratings')->first();
        $upRate = $report->ratings->where('rating_type', 'up')->count();
        $downRate = $report->ratings->where('rating_type', 'down')->count();

        $apikey = hash('sha256', 'johndoeapikey');
        $response = $this->getJson('/api/reports/' . $report->id, [
            'X-API-KEY' => $apikey,
        ]);

        $response->assertStatus(200)
            ->assertJson([
                'id' => $report->id,
                'title' => $report->title,
                'category' => $report->category->category,
                'description' => $report->description,
                'media' => $report->media,
                'latitude' => $report->latitude,
                'longitude' => $report->longitude,
                'address' => $report->address,
                'up_rate' => $upRate,
                'down_rate' => $downRate,
                'status' => $report->status->status,
                'created_at' => $report->created_at->toISOString(),
                'updated_at' => $report->updated_at->toISOString(),
            ]);
    }


    /**
     * Test showing a non-existent report.
     *
     * @return void
     */
    public function testShowReportNotFound(): void
    {
        $this->seed([DatabaseSeeder::class, ApiTestSeeder::class]);
        $apikey = hash('sha256', 'johndoeapikey');
        $response = $this->getJson('/api/reports/999999', [
            'X-API-KEY' => $apikey,
        ]);

        $response->assertStatus(404)
            ->assertJson([
                'message' => 'Report not found'
            ]);
    }

    /**
     * Test authorization error for report endpoint.
     *
     * @return void
     */
    public function testUnauthorizedAccess(): void
    {
        $this->seed([DatabaseSeeder::class, ApiTestSeeder::class]);

        $response = $this->getJson('/api/reports?page=1&size=10');

        $response->assertStatus(401)
            ->assertJson([
                'message' => 'Unauthorized'
            ]);
    }
}
