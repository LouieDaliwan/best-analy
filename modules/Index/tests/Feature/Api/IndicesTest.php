<?php

namespace Index\Tests\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Index\Models\Index;
use Index\Services\IndexServiceInterface;
use Laravel\Passport\Passport;
use Taxonomy\Models\Taxonomy;
use Tests\ActingAsUser;
use Tests\TestCase;
use Tests\WithPermissionsPolicy;

/**
 * @package Index\Tests\Feature\Api
 * @runTestsInSeparateProcesses
 * @preserveGlobalState disabled
 */
class IndicesTest extends TestCase
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
    public function a_user_can_only_retrieve_their_owned_paginated_list_of_indices()
    {
        // Arrangements
        Passport::actingAs($user = $this->asNonSuperAdmin(['indices.index']), ['indices.index']);
        $this->withPermissionsPolicy();

        $indices = factory(Index::class, 5)->create(['user_id' => $user->getKey()]);
        $taxonomy = factory(Taxonomy::class)->create(['type' => 'wrong-type', 'user_id' => $user->getKey()]);

        // Actions
        $response = $this->get(route('api.indices.index'));

        // Assertions
        $response
            ->assertSuccessful()
            ->assertJson(['data' => [['type' => $indices->random()->getType()]]])
            ->assertDontSee($taxonomy->type)
            ->assertJsonStructure([
                'data' => [[
                    'name',
                    'alias',
                    'code',
                    'description',
                    'icon',
                    'type',
                    'created',
                    'modified',
                    'deleted',
                ]]
            ]);
    }

    /**
     * @test
     * @group  feature
     * @group  feature:api
     * @group  feature:api:index
     * @return void
     */
    public function a_user_can_store_an_index_to_database()
    {
        // Arrangements
        $this->withoutExceptionHandling();
        Passport::actingAs($user = $this->asNonSuperAdmin(['indices.store']), ['indices.store']);
        $this->withPermissionsPolicy();

        // Actions
        $attributes = factory(Index::class)->make(['user_id' => $user->getKey()])->toArray();
        $attributes = array_merge($attributes, ['metadata' => ['weightage' => .25]]);
        $response = $this->post(route('api.indices.store'), $attributes);

        // Assertions
        $response->assertSuccessful();
        $this->assertDatabaseHas($this->service->getTable(), collect(
            $attributes
        )->except('metadata')->toArray());
    }

    /**
     * @test
     * @group  feature
     * @group  feature:api
     * @group  feature:api:index
     * @return void
     */
    public function a_user_can_only_retrieve_an_owned_single_index()
    {
        // Arrangements
        Passport::actingAs($user = $this->asNonSuperAdmin(['indices.show']), ['indices.show']);
        $this->withPermissionsPolicy();
        $index = factory(Index::class, 2)->create(['user_id' => $user->getKey()])->random();

        // Actions
        $response = $this->get(route('api.indices.show', $index->getKey()));

        // Assertions
        $response
            ->assertSuccessful()
            ->assertJson(['data' => ['type' => $index->getType()]])
            ->assertJsonStructure([
                'data' => [
                    'name',
                    'alias',
                    'code',
                    'description',
                    'icon',
                    'type',
                ],
            ]);
    }

    /**
     * @test
     * @group  feature
     * @group  feature:api
     * @group  feature:api:index
     * @return void
     */
    public function a_user_cannot_retrieve_a_single_index_owned_by_others()
    {
        // Arrangements
        Passport::actingAs($user = $this->asNonSuperAdmin(['indices.show']), ['indices.show']);
        $this->withPermissionsPolicy();

        $owned = factory(Index::class, 5)->create([
            'user_id' => $user->getKey()
        ])->random();
        $index = factory(Index::class, 5)->create()->random();

        // Actions
        $response = $this->get(route('api.indices.show', $index->getKey()));

        // Assertions
        $response
            ->assertForbidden();
    }

    /**
     * @test
     * @group  feature
     * @group  feature:api
     * @group  feature:api:index
     * @return void
     */
    public function a_user_can_only_update_an_owned_index()
    {
        // Arrangements
        Passport::actingAs($user = $this->asNonSuperAdmin(['indices.update']), ['indices.update']);
        $this->withPermissionsPolicy();
        $index = factory(Index::class, 3)->create(['user_id' => $user->getKey()])->random();

        // Actions
        $attributes = factory(Index::class)->make(['user_id' => $user->getKey()])->toArray();
        $attributes = array_merge($attributes, ['metadata' => ['weightage' => 0.25]]);
        $response = $this->put(route('api.indices.update', $index->getKey()), $attributes);

        // Assertions
        $response->assertSuccessful();
        $this->assertDatabaseHas($index->getTable(), collect(
            $attributes
        )->except('metadata')->toArray());
    }

    /**
     * @test
     * @group  feature
     * @group  feature:api
     * @group  feature:api:index
     * @return void
     */
    public function a_user_cannot_update_an_index_owned_by_others()
    {
        // Arrangements
        Passport::actingAs($user = $this->asNonSuperAdmin(['indices.update']), ['indices.update']);
        $this->withPermissionsPolicy();

        $owned = factory(Index::class, 5)->create([
            'user_id' => $user->getKey()
        ])->random();
        $index = factory(Index::class, 5)->create()->random();

        // Actions
        $attributes = factory(Index::class)->make(['user_id' => $user->getKey()])->toArray();
        $response = $this->put(route('api.indices.update', $index->getKey()), $attributes);

        // Assertions
        $response->assertForbidden();
    }

    /**
     * @test
     * @group  feature
     * @group  feature:api
     * @group  feature:api:index
     * @return void
     */
    public function a_user_can_only_soft_delete_an_owned_index()
    {
        // Arrangements
        Passport::actingAs($user = $this->asNonSuperAdmin(['indices.destroy']), ['indices.destroy']);
        $this->withPermissionsPolicy();
        $index = factory(Index::class, 3)->create(['user_id' => $user->getKey()])->random();

        // Actions
        $response = $this->delete(route('api.indices.destroy', $index->getKey()));
        $index = $this->service->withTrashed()->find($index->getKey());

        // Assertions
        $response->assertSuccessful();
        $this->assertSoftDeleted($index->getTable(), $index->toArray());
    }

    /**
     * @test
     * @group  feature
     * @group  feature:api
     * @group  feature:api:index
     * @return void
     */
    public function a_user_cannot_soft_delete_an_index_owned_by_others()
    {
        // Arrangements
        Passport::actingAs($user = $this->asNonSuperAdmin(['indices.destroy']), ['indices.destroy']);
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
     * @return void
     */
    public function a_user_can_only_soft_delete_multiple_owned_indices()
    {
        // Arrangements
        Passport::actingAs($user = $this->asNonSuperAdmin(['indices.destroy']), ['indices.destroy']);
        $this->withPermissionsPolicy();
        $indices = factory(Index::class, 3)->create(['user_id' => $user->getKey()]);

        // Actions
        $attributes = ['id' => $indices->pluck('id')->toArray()];
        $response = $this->delete(route('api.indices.destroy', 'null'), $attributes);
        $indices = $this->service->onlyTrashed();

        // Assertions
        $response->assertSuccessful();
        $indices->each(function ($index) {
            $this->assertSoftDeleted($index->getTable(), $index->toArray());
        });
    }

    /**
     * @test
     * @group  feature
     * @group  feature:api
     * @group  feature:api:index
     * @return void
     */
    public function a_user_cannot_soft_delete_multiple_indices_owned_by_others()
    {
        // Arrangements
        Passport::actingAs($user = $this->asNonSuperAdmin(['indices.destroy']), ['indices.destroy']);
        $this->withPermissionsPolicy();
        $indices = factory(Index::class, 3)->create();

        // Actions
        $attributes = ['id' => $indices->pluck('id')->toArray()];
        $response = $this->delete(route('api.indices.destroy', 'null'), $attributes);

        // Assertions
        $response->assertForbidden();
    }

    /**
     * @test
     * @group  feature
     * @group  feature:api
     * @group  feature:api:index
     * @return void
     */
    public function a_user_can_only_retrieve_their_owned_paginated_list_of_trashed_indices()
    {
        // Arrangements
        Passport::actingAs($user = $this->asNonSuperAdmin(['indices.trashed']), ['indices.trashed']);
        $this->withPermissionsPolicy();
        $indices = factory(Index::class, 2)->create(['user_id' => $user->getKey()]);
        $indices->each->delete();

        // Actions
        $response = $this->get(route('api.indices.trashed'));

        // Assertions
        $response
            ->assertSuccessful()
            ->assertJson(['data' => [['type' => with(new Index)->getType()]]])
            ->assertJsonStructure([
                'data' => [[
                    'name',
                    'alias',
                    'code',
                    'description',
                    'icon',
                    'type',
                    'created',
                    'modified',
                    'deleted',
                ]],
            ]);
    }

    /**
     * @test
     * @group  feature
     * @group  feature:api
     * @group  feature:api:index
     * @return void
     */
    public function a_user_can_only_restore_owned_destroyed_indices()
    {
        // Arrangements
        Passport::actingAs($user = $this->asNonSuperAdmin(['indices.restore']), ['indices.restore']);
        $this->withPermissionsPolicy();
        $index = factory(Index::class, 3)->create(['user_id' => $user->getKey()])->random();
        $index->delete();

        // Actions
        $response = $this->patch(route('api.indices.restore', $index->getKey()));
        $index = $this->service->find($index->getKey());

        // Assertions
        $response->assertSuccessful();
        $this->assertFalse($index->trashed());
    }

    /**
     * @test
     * @group  feature
     * @group  feature:api
     * @group  feature:api:index
     * @return void
     */
    public function a_user_cannot_restore_destroyed_indices_owned_by_others()
    {
        // Arrangements
        Passport::actingAs($user = $this->asNonSuperAdmin(['indices.restore']), ['indices.restore']);
        $this->withPermissionsPolicy();
        $index = factory(Index::class, 3)->create()->random();
        $index->delete();

        // Actions
        $response = $this->patch(route('api.indices.restore', $index->getKey()));
        $index = $this->service->withTrashed()->find($index->getKey());

        // Assertions
        $response->assertForbidden();
        $this->assertTrue($index->trashed());
    }

    /**
     * @test
     * @group  feature
     * @group  feature:api
     * @group  feature:api:index
     * @return void
     */
    public function a_user_can_only_restore_multiple_owned_destroyed_indices()
    {
        // Arrangements
        Passport::actingAs($user = $this->asNonSuperAdmin(['indices.restore']), ['indices.restore']);
        $this->withPermissionsPolicy();
        $indices = factory(Index::class, 3)->create(['user_id' => $user->getKey()]);
        $indices->each->delete();

        // Actions
        $attributes = ['id' => $indices->pluck('id')->toArray()];
        $response = $this->patch(route('api.indices.restore'), $attributes);
        $indices = $this->service->whereIn('id', $attributes['id'])->get();

        // Assertions
        $response->assertSuccessful();
        $indices->each(function ($index) {
            $this->assertFalse($index->trashed());
        });
    }

    /**
     * @test
     * @group  feature
     * @group  feature:api
     * @group  feature:api:index
     * @return void
     */
    public function a_user_cannot_restore_multiple_destroyed_indices_owned_by_others()
    {
        // Arrangements
        Passport::actingAs($user = $this->asNonSuperAdmin(['indices.restore']), ['indices.restore']);
        $this->withPermissionsPolicy();
        $indices = factory(Index::class, 3)->create();
        $indices->each->delete();

        // Actions
        $attributes = ['id' => $indices->pluck('id')->toArray()];
        $response = $this->patch(route('api.indices.restore'), $attributes);
        $indices = $this->service->withTrashed()->whereIn('id', $attributes['id'])->get();

        // Assertions
        $response->assertForbidden();
        $indices->each(function ($index) {
            $this->assertTrue($index->trashed());
        });
    }

    /**
     * @test
     * @group  feature
     * @group  feature:api
     * @group  feature:api:index
     * @return void
     */
    public function a_user_can_only_permanently_delete_an_owned_index()
    {
        // Arrangements
        Passport::actingAs($user = $this->asNonSuperAdmin(['indices.delete']), ['indices.delete']);
        $this->withPermissionsPolicy();
        $index = factory(Index::class, 2)->create(['user_id' => $user->getKey()])->random();

        // Actions
        $response = $this->delete(route('api.indices.delete', $index->getKey()));

        // Assertions
        $response->assertSuccessful();
        $this->assertDatabaseMissing($index->getTable(), $index->toArray());
    }

    /**
     * @test
     * @group  feature
     * @group  feature:api
     * @group  feature:api:index
     * @return void
     */
    public function a_user_cannot_permanently_delete_an_index_owned_by_others()
    {
        // Arrangements
        Passport::actingAs($user = $this->asNonSuperAdmin(['indices.delete']), ['indices.delete']);
        $this->withPermissionsPolicy();
        $index = factory(Index::class, 2)->create()->random();

        // Actions
        $response = $this->delete(route('api.indices.delete', $index->getKey()));

        // Assertions
        $response->assertForbidden();
        $this->assertDatabaseHas($index->getTable(), $index->toArray());
    }

    /**
     * @test
     * @group  feature
     * @group  feature:api
     * @group  feature:api:index
     * @return void
     */
    public function a_user_can_only_permanently_delete_multiple_owned_indices()
    {
        // Arrangements
        Passport::actingAs($user = $this->asNonSuperAdmin(['indices.delete']), ['indices.delete']);
        $this->withPermissionsPolicy();
        $indices = factory(Index::class, 3)->create(['user_id' => $user->getKey()]);

        // Actions
        $attributes = ['id' => $indices->pluck('id')->toArray()];
        $response = $this->delete(route('api.indices.delete'), $attributes);

        // Assertions
        $response->assertSuccessful();
        $indices->each(function ($index) {
            $this->assertDatabaseMissing($index->getTable(), $index->toArray());
        });
    }

    /**
     * @test
     * @group  feature
     * @group  feature:api
     * @group  feature:api:index
     * @return void
     */
    public function a_user_cannot_permanently_delete_multiple_indices_owned_by_others()
    {
        // Arrangements
        Passport::actingAs($user = $this->asNonSuperAdmin(['indices.delete']), ['indices.delete']);
        $this->withPermissionsPolicy();
        $indices = factory(Index::class, 3)->create();

        // Actions
        $attributes = ['id' => $indices->pluck('id')->toArray()];
        $response = $this->delete(route('api.indices.delete'), $attributes);

        // Assertions
        $response->assertForbidden();
        $indices->each(function ($index) {
            $this->assertDatabaseHas($index->getTable(), $index->toArray());
        });
    }
}
