<?php

namespace Index\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Index\Models\Index;
use Index\Services\IndexServiceInterface;
use Laravel\Passport\Passport;
use Tests\ActingAsUser;
use Tests\TestCase;
use Tests\WithPermissionsPolicy;

/**
 * @package Index\Feature\Api
 * @runTestsInSeparateProcesses
 * @preserveGlobalState disabled
 */
class IconCanBeUploadedIndicesTest extends TestCase
{
    use RefreshDatabase, WithFaker, ActingAsUser, WithPermissionsPolicy;

    /** Set up the service class */
    public function setUp(): void
    {
        parent::setUp();

        $this->service = $this->app->make(IndexServiceInterface::class);
    }

    /**
     * @test
     * @group  feature
     * @group  feature:api
     * @group  feature:api:index
     * @return void
     */
    public function a_user_can_store_an_icon_as_file_to_database()
    {
        // Arrangements
        Passport::actingAs($user = $this->asNonSuperAdmin(['indices.store']), ['indices.store']);
        $this->WithPermissionsPolicy();

        // Actions
        $index = factory(Index::class)->make(['user_id' => $user->getKey()]);
        $attributes = array_merge($index->toArray(), [
            'photo' => UploadedFile::fake()->image('best-analytics.jpeg'),
            'metadata' => ['weightage' => 0.25],
        ]);

        $response = $this->post(route('api.indices.store'), $attributes);
        $index = $this->service->first();

        // Assertions
        $response->assertSuccessful();
        $this->assertStringContainsString('best-analytics', $index->icon);
        $this->assertFileExists(storage_path(sprintf('modules/%s/%s/%s', date('Y-m-d'), $this->service->getTable(), basename($index->icon)
        )));
    }

    /**
     * @test
     * @group  feature
     * @group  feature:api
     * @group  feature:api:index
     * @return void
     */
    public function a_user_can_update_an_icon_as_file_to_database()
    {
        // Arrangements
        Passport::actingAs($user = $this->asNonSuperAdmin(['indices.update']), ['indices.update']);
        $this->withPermissionsPolicy();

        $index = factory(Index::class)->create(['user_id' => $user->getKey()]);
        $attributes = array_merge($index->toArray(), [
            'photo' => UploadedFile::fake()->image(
                $filename = sprintf(
                    '%s.%s', $this->faker->unixTime(),
                    $this->faker->fileExtension()
                )
            ),
            'metadata' => ['weightage' => 0.25],
        ]);

        // Actions
        $response = $this->put(route('api.indices.update', $index->getKey()), $attributes);
        $index = $this->service->find($index->getKey());

        // Assertions
        $response->assertSuccessful();
        $this->assertStringContainsString($filename, $index->icon);
        $this->assertFileExists(storage_path(sprintf(
            'modules/%s/%s/%s', date('Y-m-d'),
            $this->service->getTable(), basename($index->icon)
        )));
    }
}
