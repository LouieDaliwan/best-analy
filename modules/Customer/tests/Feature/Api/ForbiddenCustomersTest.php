<?php

namespace Customer\Tests\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Index\Models\Index;
use Index\Services\IndexServiceInterface;
use Laravel\Passport\Passport;
use Tests\ActingAsUser;
use Tests\TestCase;
use Tests\WithPermissionsPolicy;

/**
 * @package Customer\Tests\Feature\Api
 * @runTestsInSeparateProcesses
 * @preserveGlobalState disabled
 */
class ForbiddenCustomersTest extends TestCase
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
     * @group  feature:api:customer
     * @group  feature:api:customer:forbidden
     * @return void
     */
    public function an_unpermitted_user_cannot_retrieve_the_paginated_list_of_all_customers()
    {
        // Arrangements
        Passport::actingAs($this->asNonSuperAdmin(['wrong-permission']), ['wrong-permission']);
        $this->withPermissionsPolicy();

        // Actions
        $response = $this->get(route('api.customers.index'));

        // Assertions
        $response->assertForbidden();
    }

    /**
     * @test
     * @group  feature
     * @group  feature:api
     * @group  feature:api:customer
     * @group  feature:api:customer:forbidden
     * @return void
     */
    public function an_unpermitted_user_cannot_store_a_customer_to_database()
    {
        // Arrangements
        Passport::actingAs($this->asNonSuperAdmin(['wrong-permission']), ['wrong-permission']);
        $this->withPermissionsPolicy();

        // Actions
        $attributes = factory(Index::class)->make()->toArray();
        $response = $this->post(route('api.customers.store'), $attributes);

        // Assertions
        $response->assertForbidden();
    }

    /**
     * @test
     * @group  feature
     * @group  feature:api
     * @group  feature:api:customer
     * @group  feature:api:customer:forbidden
     * @return void
     */
    public function an_unpermitted_user_cannot_retrieve_a_single_customer()
    {
        // Arrangements
        Passport::actingAs($this->asNonSuperAdmin(['wrong-permission']), ['wrong-permission']);
        $this->withPermissionsPolicy();
        $customer = factory(Index::class, 2)->create()->random();

        // Actions
        $response = $this->get(route('api.customers.show', $customer->getKey()));

        // Assertions
        $response->assertForbidden();
    }

    /**
     * @test
     * @group  feature
     * @group  feature:api
     * @group  feature:api:customer
     * @group  feature:api:customer:forbidden
     * @return void
     */
    public function an_unpermitted_user_cannot_update_a_customer()
    {
        // Arrangements
        Passport::actingAs($this->asNonSuperAdmin(['wrong-permission']), ['wrong-permission']);
        $this->withPermissionsPolicy();
        $customer = factory(Index::class, 2)->create()->random();

        // Actions
        $attributes = factory(Index::class)->make()->toArray();
        $response = $this->put(route('api.customers.update', $customer->getKey()), $attributes);

        // Assertions
        $response->assertForbidden();
    }

    /**
     * @test
     * @group  feature
     * @group  feature:api
     * @group  feature:api:customer
     * @group  feature:api:customer:forbidden
     * @return void
     */
    public function an_unpermitted_user_cannot_soft_delete_a_customer()
    {
        // Arrangements
        Passport::actingAs($this->asNonSuperAdmin(['wrong-permission']), ['wrong-permission']);
        $this->withPermissionsPolicy();
        $customer = factory(Index::class, 3)->create()->random();

        // Actions
        $response = $this->delete(route('api.customers.destroy', $customer->getKey()));
        $customer = $this->service->withTrashed()->find($customer->getKey());

        // Assertions
        $response->assertForbidden();
    }

    /**
     * @test
     * @group  feature
     * @group  feature:api
     * @group  feature:api:customer
     * @group  feature:api:customer:forbidden
     * @return void
     */
    public function an_unpermitted_user_cannot_soft_delete_multiple_customers()
    {
        // Arrangements
        Passport::actingAs($this->asNonSuperAdmin(['wrong-permission']), ['wrong-permission']);
        $this->withPermissionsPolicy();
        $customers = factory(Index::class, 3)->create();

        // Actions
        $attributes = ['id' => $customers->pluck('id')->toArray()];
        $response = $this->delete(route('api.customers.destroy', 'null'), $attributes);
        $customers = $this->service->onlyTrashed();

        // Assertions
        $response->assertForbidden();
    }

    /**
     * @test
     * @group  feature
     * @group  feature:api
     * @group  feature:api:customer
     * @group  feature:api:customer:forbidden
     * @return void
     */
    public function an_unpermitted_user_cannot_retrieve_the_paginated_list_of_all_trashed_customers()
    {
        // Arrangements
        Passport::actingAs($this->asNonSuperAdmin(['wrong-permission']), ['wrong-permission']);
        $this->withPermissionsPolicy();
        $customers = factory(Index::class, 2)->create();
        $customers->each->delete();

        // Actions
        $response = $this->get(route('api.customers.trashed'));

        // Assertions
        $response->assertForbidden();
    }

    /**
     * @test
     * @group  feature
     * @group  feature:api
     * @group  feature:api:customer
     * @group  feature:api:customer:forbidden
     * @return void
     */
    public function an_unpermitted_user_cannot_restore_destroyed_customers()
    {
        // Arrangements
        Passport::actingAs($this->asNonSuperAdmin(['wrong-permission']), ['wrong-permission']);
        $this->withPermissionsPolicy();
        $customer = factory(Index::class, 3)->create()->random();
        $customer->delete();

        // Actions
        $response = $this->patch(route('api.customers.restore', $customer->getKey()));

        // Assertions
        $response->assertForbidden();
    }

    /**
     * @test
     * @group  feature
     * @group  feature:api
     * @group  feature:api:customer
     * @group  feature:api:customer:forbidden
     * @return void
     */
    public function an_unpermitted_user_cannot_restore_multiple_destroyed_customers()
    {
        // Arrangements
        Passport::actingAs($this->asNonSuperAdmin(['wrong-permission']), ['wrong-permission']);
        $this->withPermissionsPolicy();
        $customers = factory(Index::class, 3)->create();
        $customers->each->delete();

        // Actions
        $attributes = ['id' => $customers->pluck('id')->toArray()];
        $response = $this->patch(route('api.customers.restore'), $attributes);

        // Assertions
        $response->assertForbidden();
    }

    /**
     * @test
     * @group  feature
     * @group  feature:api
     * @group  feature:api:customer
     * @group  feature:api:customer:forbidden
     * @return void
     */
    public function an_unpermitted_user_cannot_permanently_delete_a_customer()
    {
        // Arrangements
        Passport::actingAs($this->asNonSuperAdmin(['wrong-permission']), ['wrong-permission']);
        $this->withPermissionsPolicy();
        $customer = factory(Index::class, 2)->create()->random();

        // Actions
        $response = $this->delete(route('api.customers.delete', $customer->getKey()));

        // Assertions
        $response->assertForbidden();
    }

    /**
     * @test
     * @group  feature
     * @group  feature:api
     * @group  feature:api:customer
     * @group  feature:api:customer:forbidden
     * @return void
     */
    public function an_unpermitted_user_cannot_permanently_delete_multiple_customers()
    {
        // Arrangements
        Passport::actingAs($this->asNonSuperAdmin(['wrong-permission']), ['wrong-permission']);
        $this->withPermissionsPolicy();
        $customers = factory(Index::class, 3)->create();

        // Actions
        $attributes = ['id' => $customers->pluck('id')->toArray()];
        $response = $this->delete(route('api.customers.delete'), $attributes);

        // Assertions
        $response->assertForbidden();
    }

}
