<?php

namespace Survey\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Passport\Passport;
use Survey\Models\Field;
use Survey\Models\Survey;
use Survey\Services\FieldServiceInterface;
use Tests\ActingAsUser;
use Tests\TestCase;
use Tests\WithPermissionsPolicy;

/**
 * @package Survey\Feature\Api
 * @runTestsInSeparateProcesses
 * @preserveGlobalState disabled
 */
class FormFieldTest extends TestCase
{
    use RefreshDatabase, WithFaker, ActingAsUser, WithPermissionsPolicy;

    /** Set up the service class */
    public function setUp(): void
    {
        parent::setUp();

        $this->service = $this->app->make(FieldServiceInterface::class);
    }

    /**
     * @test
     * @group  feature
     * @group  feature:api
     * @group  feature:api:field
     * @return void
     */
    public function a_user_can_store_a_form_field_to_database()
    {
        // Arrangements
        $this->withoutExceptionHandling();
        Passport::actingAs($user = $this->asNonSuperAdmin(['surveys.store']), ['surveys.store']);
        $this->withPermissionsPolicy();

        // Actions
        $survey = factory(Survey::class)->make(['user_id' => $user->getKey()]);
        $survey = array_merge($survey->toArray(), [
            'fields' => $attributes = factory(Field::class, 1)->make([
                'form_id' => null,
                'metadata' => null,
            ])->toArray(),
        ]);
        $response = $this->post(route('api.surveys.store'), $survey);

        // Assertions
        $response->assertSuccessful();
        collect($attributes)->each(function ($attribute) {
            $this->assertDatabaseHas($this->service->getTable(), collect($attribute)->except(['form_id', 'metadata'])->toArray());
        });
    }

    /**
     * @test
     * @group  feature
     * @group  feature:api
     * @group  feature:api:field
     * @return void
     */
    public function a_user_can_only_update_a_form_field()
    {
        // Arrangemets
        Passport::actingAs($user = $this->asNonSuperAdmin(['surveys.update']), ['$surveys.update']);
        $this->withPermissionsPolicy();
        $surveys = factory(Survey::class, 2)->create(['user_id' => $user->getKey()])->random();
        $fields = [];
        $surveys->each(function ($survey) use ($fields) {
            $fields[] = factory(Field::class, 10)->create(['form_id' => $survey->getKey()]);
        });

        // Actions
        $attributes = factory(Survey::class)->make(['user_id' => $user->getKey()])->toArray();
        $response = $this->put(route('api.surveys.update', $surveys->getKey()), $attributes);

        // Assertions
        $response->assertSuccessful();
        $this->assertDatabaseHas($surveys->getTable(), $attributes);
    }

    /**
     * @test
     * @group  feature
     * @group  feature:api
     * @group  feature:api:field
     * @return void
     */
    public function a_user_can_only_permanently_delete_a_owned_form_field()
    {
        // Arrangemets
        Passport::actingAs($user = $this->asNonSuperAdmin(['surveys.delete']), ['surveys.delete']);
        $this->withPermissionsPolicy();

        $survey = factory(Survey::class)->make(['user_id' => $user->getKey()]);
        $survey = array_merge($survey->toArray(), [
            'fields' => $attributes = factory(Field::class, 1)->make([
                'form_id' => null,
                'metadata' => null,
            ])->toArray(),
        ]);

        // Actions
        $response = $this->delete(route('api.surveys.delete'), $survey);

        // Assertions
        $response->assertSuccessful();
        collect($attributes)->each(function ($attribute) {
            $this->assertDatabaseMissing($this->service->getTable(), collect($attribute)->except('form_id')->toArray());
        });
    }

    /**
     * @test
     * @group  feature
     * @group  feature:api
     * @group  feature:api:field
     * @return void
     */
    public function a_user_can_only_permanently_delete_multiple_owned_form_fields()
    {
        // Arrangemets
        Passport::actingAs($user = $this->asNonSuperAdmin(['surveys.delete']), ['surveys.delete']);
        $this->withPermissionsPolicy();

        $surveys = factory(Survey::class)->make(['user_id' => $user->getKey()]);
        $fields = [];
        $surveys->each(function ($survey) use ($fields) {
            $fields[] = factory(Field::class, 10)->create([
                'form_id' => $survey->getKey(),
                'metadata' => null,
            ]);
        });

        // Actions
        $attributes = $surveys->toArray();
        $response = $this->delete(route('api.surveys.delete'), $attributes);

        // Arrangemets
        $response->assertSuccessful();
        collect($attributes)->each(function ($attribute) {
            $this->assertDatabaseMissing($this->service->getTable(), collect($attribute)->except('form_id')->toArray());
        });
    }

    /**
     * @test
     * @group  feature
     * @group  feature:api
     * @group  feature:api:field
     * @return void
     */
    public function a_user_cannot_retrieve_the_paginated_list_of_form_fields_owned_by_others()
    {
        // Arrangemets
        Passport::actingAs($user = $this->asNonSuperAdmin(['surveys.index']), ['surveys.index']);
        $this->withPermissionsPolicy();
        $owned = factory(Survey::class, 5)->create(['user_id' => $user->getKey()]);
        $surveys = factory(Survey::class, 2)->create()->random();
        $fields = [];
        $surveys->each(function ($survey) use ($fields) {
            $fields[] = factory(Field::class, 10)->create(['form_id' => $survey->getKey()]);
        });

        // Actions
        $response = $this->get(route('api.surveys.index'));

        // Assertions
        $response
            ->assertSuccessful();
    }

    /**
     * @test
     * @group  feature
     * @group  feature:api
     * @group  feature:api:field
     * @return void
     */
    public function a_user_cannot_retrieve_a_single_form_field_owned_by_others()
    {
        // Arrangemets
        Passport::actingAs($user = $this->asNonSuperAdmin(['surveys.show']), ['surveys.show']);
        $this->withPermissionsPolicy();
        $surveys = factory(Survey::class, 2)->create()->random();
        $fields = [];
        $surveys->each(function ($survey) use ($fields) {
            $fields[] = factory(Field::class, 10)->create(['form_id' => $survey->getKey()]);
        });

        // Actions
        $response = $this->get(route('api.surveys.show', $surveys->getKey()));

        // Assertions
        $response->assertForbidden();

    }

    /**
     * @test
     * @group  feature
     * @group  feature:api
     * @group  feature:api:field
     * @return void
     */
    public function a_user_cannot_update_a_form_field_owned_by_others()
    {
        // Arrangemets
        Passport::actingAs($user = $this->asNonSuperAdmin(['surveys.update']), ['$surveys.update']);
        $this->withPermissionsPolicy();
        $surveys = factory(Survey::class, 2)->create()->random();
        $fields = [];
        $surveys->each(function ($survey) use ($fields) {
            $fields[] = factory(Field::class, 10)->create(['form_id' => $survey->getKey()]);
        });

        // Actions
        $attributes = factory(Survey::class)->make(['user_id' => $user->getKey()])->toArray();
        $response = $this->put(route('api.surveys.update', $surveys->getKey()), $attributes);

        // Assertions
        $response->assertForbidden();
    }

    /**
     * @test
     * @group  feature
     * @group  feature:api
     * @group  feature:api:field
     * @return void
     */
    public function a_user_cannot_permanently_delete_a_form_field_owned_by_others()
    {
        // Arrangemets
        Passport::actingAs($user = $this->asNonSuperAdmin(['surveys.delete']), ['surveys.delete']);
        $this->withPermissionsPolicy();

        $survey = factory(Survey::class, 2)->create()->random();
        $survey = array_merge($survey->toArray(), [
            'fields' => $attributes = factory(Field::class, 1)->make([
                'form_id' => null,
                'metadata' => null,
            ])->toArray(),
        ]);

        // Actions
        $response = $this->delete(route('api.surveys.delete'), $survey);

        // Assertions
        $response->assertForbidden();
        collect($attributes)->each(function ($attribute) {
            $this->assertDatabaseMissing($this->service->getTable(), collect($attribute)->except('form_id')->toArray());
        });
    }
}
