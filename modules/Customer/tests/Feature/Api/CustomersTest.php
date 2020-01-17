<?php

namespace Customer\Feature\Api;

use Customer\Models\Customer;
use Customer\Services\CustomerServiceInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Passport\Passport;
use Tests\ActingAsUser;
use Tests\TestCase;
use Tests\WithPermissionsPolicy;
use User\Models\Role;
use User\Models\User;

/**
 * @package Customer\Feature\Api
 * @runTestsInSeparateProcesses
 * @preserveGlobalState disabled
 */
class CustomersTest extends TestCase
{
    use RefreshDatabase, WithFaker, ActingAsUser, WithPermissionsPolicy;

    /** Set up the service class */
    public function setUp(): void
    {
        parent::setUp();

        $this->service = $this->app->make(CustomerServiceInterface::class);
        $this->superAdmin = $this->asSuperAdmin();
    }

    /**
     * @test
     * @group  feature
     * @group  feature:api
     * @group  feature:api:customer
     * @return void
     */
    public function a_user_can_only_view_their_owned_paginated_list_of_customers()
    {
        // Arrangements
        Passport::actingAs($user = $this->asNonSuperAdmin(['customers.index', 'customers.owned']), ['customers.index']);
        $this->withPermissionsPolicy();
        $customers = factory(Customer::class, 3)->create(['user_id' => $user->getKey()])->random();

        // Actions
        $response = $this->get(route('api.customers.index'));

        // Assertions
        $response
            ->assertSuccessful()
            ->assertJson(['data' => [['user_id' => $user->getKey()]]])
            ->assertJsonStructure([
                'data' => [[
                    'name',
                    'refnum',
                    'code',
                    'user_id',
                    'status',
                    'created',
                    'modified',
                ]],
            ]);
    }

    /**
     * @test
     * @group  feature
     * @group  feature:api
     * @group  feature:api:customer
     * @return void
     */
    public function a_user_can_only_view_their_owned_paginated_list_of_trashed_customers()
    {
        // Arrangements
        Passport::actingAs($user = $this->asNonSuperAdmin(['customers.trashed', 'customers.owned']), ['customers.trashed']);
        $this->withPermissionsPolicy();
        $customers = factory(Customer::class, 2)->create(['user_id' => $user->getKey()]);
        $customers->each->delete();

        // Actions
        $response = $this->get(route('api.customers.trashed'));

        // Assertions
        $response
            ->assertSuccessful()
            ->assertJson(['data' => [['user_id' => $user->getKey()]]])
            ->assertJsonStructure([
                'data' => [[
                    'name',
                    'refnum',
                    'code',
                    'status',
                    'created',
                    'deleted',
                    'modified',
                ]],
            ]);
    }

    /**
     * @test
     * @group  feature
     * @group  feature:api
     * @group  feature:api:customer
     * @return void
     */
    public function a_user_can_visit_their_owned_customer_page()
    {
        // Arrangements
        Passport::actingAs($user = $this->asNonSuperAdmin(['customers.show', 'customers.owned']), ['customers.show']);
        $this->withPermissionsPolicy();
        $customer = factory(Customer::class, 2)->create(['user_id' => $user->getKey()])->random();

       // Actions
       $response = $this->get(route('api.customers.show', $customer->getKey()));

       // Assetions
       $response
            ->assertSuccessful()
            ->assertJson(['data' => ['user_id' => $user->getKey()]])
            ->assertJsonStructure([
                'data' => [
                    'name',
                    'refnum',
                    'code',
                    'status',
                    'created',
                    'modified',
                ],
            ]);
    }

    /**
     * @test
     * @group  feature
     * @group  feature:api
     * @group  feature:api:customer
     * @return void
     */
    public function a_user_can_visit_any_customer_page()
    {
        // Arrangements
        Passport::actingAs($user = $this->asNonSuperAdmin(['customers.show']), ['customers.show']);
        $this->withPermissionsPolicy();
        $customer = factory(Customer::class, 2)->create(['user_id' => $user->getKey()])->random();

       // Actions
       $response = $this->get(route('api.customers.show', $customer->getKey()));

       // Assetions
       $response
            ->assertSuccessful()
            ->assertJson(['data' => ['user_id' => $user->getKey()]])
            ->assertJsonStructure([
                'data' => [
                    'name',
                    'refnum',
                    'code',
                    'status',
                    'created',
                    'modified',
                ],
            ]);
    }

    /**
     * @test
     * @group  feature
     * @group  feature:api
     * @group  feature:api:customer
     * @return void
     */
    public function a_user_can_store_a_customer_to_database()
    {
        // Arrangements
        Passport::actingAs($user = $this->asNonSuperAdmin(['customers.store']), ['customers.store']);
        $this->withPermissionsPolicy();

        // Actions
        $attributes = factory(Customer::class)->make(['user_id' => $user->getKey()])->toArray();
        $response = $this->post(route('api.customers.store'), $attributes);

        // Assertions
        $response->assertSuccessful();
        $this->assertDatabaseHas($this->service->getTable(), $attributes);
    }

    /**
     * @test
     * @group  feature
     * @group  feature:api
     * @group  feature:api:customer
     * @return void
     */
    public function a_user_can_only_update_their_owned_customers()
    {
        // Arrangements
        Passport::actingAs($user = $this->asNonSuperAdmin(['customers.owned', 'customers.update']), ['customers.update']);
        $this->withPermissionsPolicy();
        $customer = factory(Customer::class, 3)->create(['user_id' => $user->getKey()])->random();

        // Actions
        $attributes = factory(Customer::class)->make()->toArray();
        $response = $this->put(route('api.customers.update', $customer->getKey()), $attributes);

        // Assertions
        $response->assertSuccessful();
        $this->assertDatabaseHas($customer->getTable(), $attributes);
    }

    /**
     * @test
     * @group  feature
     * @group  feature:api
     * @group  feature:api:customer
     * @return void
     */
    public function a_user_cannot_update_customers_owned_by_other_users()
    {
        // Arrangements
        Passport::actingAs($this->asNonSuperAdmin(['customers.owned', 'customers.update']), ['customers.update']);
        $this->withPermissionsPolicy();
        $customer = factory(Customer::class, 3)->create()->random();

        // Actions
        $attributes = factory(Customer::class)->make()->toArray();
        $response = $this->put(route('api.customers.update', $customer->getKey()), $attributes);

        // Assertions
        $response->assertForbidden();
        $this->assertDatabaseMissing($customer->getTable(), $attributes);
    }

    /**
     * @test
     * @group  feature
     * @group  feature:api
     * @group  feature:api:customer
     * @return void
     */
    public function a_user_can_only_restore_owned_customer()
    {
        // Arrangements
        Passport::actingAs($user = $this->asNonSuperAdmin(['customers.restore', 'customers.owned']), ['customers.restore']);
        $this->withPermissionsPolicy();
        $customer = factory(Customer::class, 3)->create(['user_id' => $user->getKey()])->random();

        // Actions
        $response = $this->patch(route('api.customers.restore', $customer->getKey()));
        $customer = $this->service->find($customer->getKey());

        // Assertions
        $response->assertSuccessful();
        $this->assertFalse($customer->trashed());
    }

    /**
     * @test
     * @group  feature
     * @group  feature:api
     * @group  feature:api:customer
     * @return void
     */
    public function a_user_can_only_multiple_restore_owned_customers()
    {
        // Arrangements
        Passport::actingAs($user = $this->asNonSuperAdmin(['customers.restore', 'customers.owned']), ['customers.restore']);
        $this->withPermissionsPolicy();
        $customers = factory(Customer::class, 3)->create(['user_id' => $user->getKey()])->random();

        // Actions
        $attributes = ['id' => $customers->pluck('id')->toArray()];
        $response = $this->patch(route('api.customers.restore'), $attributes);
        $customers = $this->service->whereIn('id', $attributes['id'])->get();

        // Assertions
        $response->assertSuccessful();
        $customers->each(function ($customer) {
            $this->assertFalse($customer->trashed());
        });
    }

    /**
     * @test
     * @group  feature
     * @group  feature:api
     * @group  feature:api:customer
     * @return void
     */
    public function a_user_cannot_restore_customer_owned_by_other_users()
    {
        // Arrangements
        Passport::actingAs($this->asNonSuperAdmin(['customers.restore', 'customers.owned']), ['customers.restore']);
        $this->withPermissionsPolicy();

        $otherUser = $this->asNonSuperAdmin(['customers.owned', 'customers.restore']);
        $customer = factory(Customer::class, 3)->create(['user_id' => $otherUser->getKey()])->random();

        // Actions
        $response = $this->patch(route('api.customers.restore', $customer->getKey()));

        // Assertions
        $response->assertForbidden();
        $this->assertDatabaseHas($customer->getTable(), $customer->toArray());
    }

    /**
     * @test
     * @group  feature
     * @group  feature:api
     * @group  feature:api:customer
     * @return void
     */
    public function a_user_cannot_multiple_restore_customers_owned_by_other_users()
    {
        // Arrangements
        Passport::actingAs($this->asNonSuperAdmin(['customers.restore', 'customers.owned']), ['customers.restore']);
        $this->withPermissionsPolicy();

        $otherUser = $this->asNonSuperAdmin(['customers.owned', 'customers.restore']);
        $customers = factory(Customer::class, 3)->create(['user_id' => $otherUser->getKey()]);

        // Actions
        $attributes = ['id' => $customers->pluck('id')->toArray()];
        $response = $this->patch(route('api.customers.restore'), $attributes);

        // Assertions
        $response->assertForbidden();
        $customers->each(function ($customer) {
            $this->assertDatabaseHas($customer->getTable(), $customer->toArray());
        });
    }

    /**
     * @test
     * @group  feature
     * @group  feature:api
     * @group  feature:api:customer
     * @return void
     */
    public function a_user_can_only_soft_delete_owned_customer()
    {
        // Arrangements
        Passport::actingAs($user = $this->asNonSuperAdmin(['customers.destroy', 'customers.owned']), ['customers.destroy']);
        $this->withPermissionsPolicy();
        $customer = factory(Customer::class, 3)->create(['user_id' => $user->getKey()])->random();

        // Actions
        $response = $this->delete(route('api.customers.destroy', $customer->getKey()));
        $customer = $this->service->withTrashed()->find($customer->getKey());

        // Assertions
        $response->assertSuccessful();
        $this->assertSoftDeleted($customer->getTable(), $customer->toArray());
    }

    /**
     * @test
     * @group  feature
     * @group  feature:api
     * @group  feature:api:customer
     * @return void
     */
    public function a_user_can_only_multiple_soft_delete_owned_customers()
    {
        // Arrangements
        Passport::actingAs($user = $this->asNonSuperAdmin(['customers.destroy', 'customers.owned']), ['customers.destroy']);
        $this->withPermissionsPolicy();
        $customers = factory(Customer::class, 3)->create(['user_id' => $user->getKey()])->random();

        // Actions
        $attributes = ['id' => $customers->pluck('id')->toArray()];
        $response = $this->delete(route('api.customers.destroy', 'null'), $attributes);
        $customers = $this->service->onlyTrashed();

        // Assertions
        $response->assertSuccessful();
        $customers->each(function ($customer) {
            $this->assertSoftDeleted($customer->getTable(), $customer->toArray());
        });
    }

    /**
     * @test
     * @group  feature
     * @group  feature:api
     * @group  feature:api:customer
     * @return void
     */
    public function a_user_cannot_soft_delete_customer_owned_by_other_users()
    {
        // Arrangements
        Passport::actingAs($this->asNonSuperAdmin(['customers.destroy', 'customers.owned']), ['customers.destroy']);
        $this->withPermissionsPolicy();
        $customer = factory(Customer::class, 3)->create()->random();

        // Actions
        $response = $this->delete(route('api.customers.destroy', $customer->getKey()));

        // Assertions
        $response->assertForbidden();
        $this->assertDatabaseHas($customer->getTable(), $customer->toArray());
    }

    /**
     * @test
     * @group  feature
     * @group  feature:api
     * @group  feature:api:customer
     * @return void
     */
    public function a_user_cannot_multiple_soft_delete_customers_owned_by_other_users()
    {
        // Arrangements
        Passport::actingAs($this->asNonSuperAdmin(['customers.destroy', 'customers.owned']), ['customers.destroy']);
        $this->withPermissionsPolicy();
        $customers = factory(Customer::class, 3)->create();

        // Actions
        $attributes = ['id' => $customers->pluck('id')->toArray()];
        $response = $this->delete(route('api.customers.destroy', 'null'), $attributes);

        // Assertions
        $response->assertForbidden();
        $customers->each(function ($customer) {
            $this->assertDatabaseHas($customer->getTable(), $customer->toArray());
        });
    }

    /**
     * @test
     * @group  feature
     * @group  feature:api
     * @group  feature:api:customer
     * @return void
     */
    public function a_user_can_only_permanently_delete_owned_customer()
    {
        // Arrangements
        Passport::actingAs($user = $this->asNonSuperAdmin(['customers.delete', 'customers.owned']), ['customers.delete']);
        $this->withPermissionsPolicy();
        $customer = factory(Customer::class, 2)->create(['user_id' => $user->getKey()])->random();

        // Actions
        $response = $this->delete(route('api.customers.delete', $customer->getKey()));

        // Assertions
        $response->assertSuccessful();
        $this->assertDatabaseMissing($customer->getTable(), $customer->toArray());
    }

    /**
     * @test
     * @group  feature
     * @group  feature:api
     * @group  feature:api:customer
     * @return void
     */
    public function a_user_can_only_multiple_permanently_delete_owned_customers()
    {
        // Arrangements
        Passport::actingAs($user = $this->asNonSuperAdmin(['customers.delete', 'customers.owned']), ['customers.delete']);
        $this->withPermissionsPolicy();
        $customers = factory(Customer::class, 3)->create(['user_id' => $user->getKey()])->random();

       // Actions
       $attributes = ['id' => $customers->pluck('id')->toArray()];
       $response = $this->delete(route('api.customers.delete'), $attributes);

       // Assertions
       $response->assertSuccessful();
       $customers->each(function ($customer) {
            $this->assertDatabaseMissing($customer->getTable(), $customer->toArray());
       });
    }

    /**
     * @test
     * @group  feature
     * @group  feature:api
     * @group  feature:api:customer
     * @return void
     */
    public function a_user_cannot_permanently_delete_customer_owned_by_other_users()
    {
        // Arrangements
        Passport::actingAs($this->asNonSuperAdmin(['customers.delete', 'customers.owned']), ['customers.delete']);
        $this->withPermissionsPolicy();
        $customer = factory(Customer::class, 2)->create()->random();

        // Actions
        $response = $this->delete(route('api.customers.delete', $customer->getKey()));

        // Assertions
        $response->assertForbidden();
        $this->assertDatabaseHas($customer->getTable(), $customer->toArray());
    }

    /**
     * @test
     * @group  feature
     * @group  feature:api
     * @group  feature:api:customer
     * @return void
     */
    public function a_user_cannot_multiple_permanently_delete_customers_owned_by_other_users()
    {
        // Arrangements
        Passport::actingAs($this->asNonSuperAdmin(['customers.delete', 'customers.owned']), ['customers.delete']);
        $this->withPermissionsPolicy();
        $customers = factory(Customer::class, 3)->create();

        // Actions
        $attributes = ['id' => $customers->pluck('id')->toArray()];
        $response = $this->delete(route('api.customers.delete'), $attributes);

        // Assertions
        $response->assertForbidden();
        $customers->each(function ($customer) {
            $this->assertDatabaseHas($customer->getTable(), $customer->toArray());
        });
    }
}
