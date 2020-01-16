<?php

namespace Index\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
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
class ForbiddenIndicesTest extends TestCase
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
     * @group  feature:api:index:forbidden
     * @return void
     */
    public function an_unpermitted_user_cannot_retrieve_the_paginated_list_of_all_indices()
    {
        // Arrangements
        Passport::actingAs($this->asNonSuperAdmin(['wrong-permission']), ['wrong-permission']);
        $this->withPermissionsPolicy();

        // Actions
        $response = $this->get(route('api.indices.index'));

        // Assertions
        $response->assertForbidden();
    }

    /**
     * @test
     * @group  feature
     * @group  feature:api
     * @group  feature:api:index
     * @group  feature:api:index:forbidden
     * @return void
     */
    public function an_unpermitted_user_cannot_store_an_index_to_database()
    {
        // Arrangements
        Passport::actingAs($this->asNonSuperAdmin(['wrong-permission']), ['wrong-permission']);
        $this->withPermissionsPolicy();

        // Actions
        $attributes = factory(Index::class)->make()->toArray();
        $response = $this->post(route('api.indices.store'), $attributes);

        // Assertions
        $response->assertForbidden();
    }

    /**
     * @test
     * @group  feature
     * @group  feature:api
     * @group  feature:api:index
     * @group  feature:api:index:forbidden
     * @return void
     */
    public function an_unpermitted_user_cannot_retrieve_a_single_index()
    {
        // Arrangements
        Passport::actingAs($this->asNonSuperAdmin(['wrong-permission']), ['wrong-permission']);
        $this->withPermissionsPolicy();
        $index = factory(Index::class, 2)->create()->random();

        // Actions
        $response = $this->get(route('api.indices.show', $index->getKey()));

        // Assertions
        $response->assertForbidden();
    }

    /**
     * @test
     * @group  feature
     * @group  feature:api
     * @group  feature:api:index
     * @group  feature:api:index:forbidden
     * @return void
     */
    public function an_unpermitted_user_cannot_update_an_index()
    {
        // Arrangements
        Passport::actingAs($this->asNonSuperAdmin(['wrong-permission']), ['wrong-permission']);
        $this->withPermissionsPolicy();
        $index = factory(Index::class, 2)->create()->random();

        // Actions
        $attributes = factory(Index::class)->make()->toArray();
        $response = $this->put(route('api.indices.update', $index->getKey()), $attributes);

        // Assertions
        $response->assertForbidden();
    }

    /**
     * @test
     * @group  feature
     * @group  feature:api
     * @group  feature:api:index
     * @group  feature:api:index:forbidden
     * @return void
     */
    public function an_unpermitted_user_cannot_soft_delete_an_index()
    {
        // Arrangements
        Passport::actingAs($this->asNonSuperAdmin(['wrong-permission']), ['wrong-permission']);
        $this->withPermissionsPolicy();
        $index = factory(Index::class, 3)->create()->random();

        // Actions
        $response = $this->delete(route('api.indices.destroy', $index->getKey()));
        $index = $this->service->withTrashed()->find($index->getKey());

        // Assertions
        $response->assertForbidden();
    }

    /**
     * @test
     * @group  feature
     * @group  feature:api
     * @group  feature:api:index
     * @group  feature:api:index:forbidden
     * @return void
     */
    public function an_unpermitted_user_cannot_soft_delete_multiple_indices()
    {
        // Arrangements
        Passport::actingAs($this->asNonSuperAdmin(['wrong-permission']), ['wrong-permission']);
        $this->withPermissionsPolicy();
        $indices = factory(Index::class, 3)->create();

        // Actions
        $attributes = ['id' => $indices->pluck('id')->toArray()];
        $response = $this->delete(route('api.indices.destroy', 'null'), $attributes);
        $indices = $this->service->onlyTrashed();

        // Assertions
        $response->assertForbidden();
    }

    /**
     * @test
     * @group  feature
     * @group  feature:api
     * @group  feature:api:index
     * @group  feature:api:index:forbidden
     * @return void
     */
    public function an_unpermitted_user_cannot_retrieve_the_paginated_list_of_all_trashed_indices()
    {
        // Arrangements
        Passport::actingAs($this->asNonSuperAdmin(['wrong-permission']), ['wrong-permission']);
        $this->withPermissionsPolicy();
        $indices = factory(Index::class, 2)->create();
        $indices->each->delete();

        // Actions
        $response = $this->get(route('api.indices.trashed'));

        // Assertions
        $response->assertForbidden();
    }

    /**
     * @test
     * @group  feature
     * @group  feature:api
     * @group  feature:api:index
     * @group  feature:api:index:forbidden
     * @return void
     */
    public function an_unpermitted_user_cannot_restore_destroyed_indices()
    {
        // Arrangements
        Passport::actingAs($this->asNonSuperAdmin(['wrong-permission']), ['wrong-permission']);
        $this->withPermissionsPolicy();
        $index = factory(Index::class, 3)->create()->random();
        $index->delete();

        // Actions
        $response = $this->patch(route('api.indices.restore', $index->getKey()));

        // Assertions
        $response->assertForbidden();
    }

    /**
     * @test
     * @group  feature
     * @group  feature:api
     * @group  feature:api:index
     * @group  feature:api:index:forbidden
     * @return void
     */
    public function an_unpermitted_user_cannot_restore_multiple_destroyed_indices()
    {
        // Arrangements
        Passport::actingAs($this->asNonSuperAdmin(['wrong-permission']), ['wrong-permission']);
        $this->withPermissionsPolicy();
        $indices = factory(Index::class, 3)->create();
        $indices->each->delete();

        // Actions
        $attributes = ['id' => $indices->pluck('id')->toArray()];
        $response = $this->patch(route('api.indices.restore'), $attributes);

        // Assertions
        $response->assertForbidden();
    }

    /**
     * @test
     * @group  feature
     * @group  feature:api
     * @group  feature:api:index
     * @group  feature:api:index:forbidden
     * @return void
     */
    public function an_unpermitted_user_cannot_permanently_delete_an_index()
    {
        // Arrangements
        Passport::actingAs($this->asNonSuperAdmin(['wrong-permission']), ['wrong-permission']);
        $this->withPermissionsPolicy();
        $index = factory(Index::class, 2)->create()->random();

        // Actions
        $response = $this->delete(route('api.indices.delete', $index->getKey()));

        // Assertions
        $response->assertForbidden();
    }

    /**
     * @test
     * @group  feature
     * @group  feature:api
     * @group  feature:api:index
     * @group  feature:api:index:forbidden
     * @return void
     */
    public function an_unpermitted_user_cannot_permanently_delete_multiple_indices()
    {
        // Arrangements
        Passport::actingAs($this->asNonSuperAdmin(['wrong-permission']), ['wrong-permission']);
        $this->withPermissionsPolicy();
        $indices = factory(Index::class, 3)->create();

        // Actions
        $attributes = ['id' => $indices->pluck('id')->toArray()];
        $response = $this->delete(route('api.indices.delete'), $attributes);

        // Assertions
        $response->assertForbidden();
    }

}
