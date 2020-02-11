<?php

namespace Survey\Tests\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Passport\Passport;
use Survey\Models\Survey;
use Survey\Services\SurveyServiceInterface;
use Tests\ActingAsUser;
use Tests\TestCase;
use Tests\WithPermissionsPolicy;

/**
 * @package Survey\Tests\Feature\Api
 * @runTestsInSeparateProcesses
 * @preserveGlobalState disabled
 */
class SurveysTest extends TestCase
{
    use RefreshDatabase, WithFaker, ActingAsUser, WithPermissionsPolicy;

    /** Set up the service class */
    public function setUp(): void
    {
        parent::setUp();

        $this->service = $this->app->make(SurveyServiceInterface::class);
    }

    /**
     * @test
     * @group  feature
     * @group  feature:api
     * @group  feature:api:survey
     * @return void
     */
    public function a_user_can_only_retrieve_their_owned_paginated_list_of_surveys()
    {
        // Arrangements
        Passport::actingAs($user = $this->asNonSuperAdmin(['surveys.index']), ['surveys.index']);
        $this->withPermissionsPolicy();

        $surveys = factory(Survey::class, 5)->create(['user_id' => $user->getKey()]);

        // Actions
        $response = $this->get(route('api.surveys.index'));

        // Assertions
        $response
            ->assertSuccessful()
            ->assertJson(['data' => [['user_id' => $user->getKey()]]])
            ->assertJsonStructure([
                'data' => [[
                    'title',
                    'code',
                    'body',
                    'user_id',
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
     * @group  feature:api:survey
     * @return void
     */
    public function a_user_cannot_retrieve_the_paginated_list_of_surveys_owned_by_others()
    {
        // Arrangements
        Passport::actingAs($user = $this->asNonSuperAdmin(['surveys.index']), ['surveys.index']);
        $this->withPermissionsPolicy();

        $owned = factory(Survey::class, 5)->create(['user_id' => $user->getKey()]);
        $surveys = factory(Survey::class, 5)->create();

        // Actions
        $response = $this->get(route('api.surveys.index'));

        // Assertions
        $response
            ->assertSuccessful()
            ->assertJson(['data' => $owned->toArray()])
            ->assertDontSee($surveys->random()->code)
            ->assertJsonMissing($surveys->toArray());
    }

    /**
     * @test
     * @group  feature
     * @group  feature:api
     * @group  feature:api:survey
     * @return void
     */
    public function a_user_can_store_an_survey_to_database()
    {
        // Arrangements
        $this->withoutExceptionHandling();
        Passport::actingAs($user = $this->asNonSuperAdmin(['surveys.store']), ['surveys.store']);
        $this->withPermissionsPolicy();

        // Actions
        $attributes = factory(Survey::class)->make(['user_id' => $user->getKey()])->toArray();
        $response = $this->post(route('api.surveys.store'), $attributes);

        // Assertions
        $response->assertSuccessful();
        $this->assertDatabaseHas($this->service->getTable(), $attributes);
    }

    /**
     * @test
     * @group  feature
     * @group  feature:api
     * @group  feature:api:survey
     * @return void
     */
    public function a_user_can_only_retrieve_an_owned_single_survey()
    {
        // Arrangements
        Passport::actingAs($user = $this->asNonSuperAdmin(['surveys.show']), ['surveys.show']);
        $this->withPermissionsPolicy();
        $survey = factory(Survey::class, 2)->create(['user_id' => $user->getKey()])->random();

        // Actions
        $response = $this->get(route('api.surveys.show', $survey->getKey()));

        // Assertions
        $response
            ->assertSuccessful()
            ->assertJson(['data' => ['user_id' => $user->getKey()]])
            ->assertJsonStructure([
                'data' => [
                    'title',
                    'code',
                    'body',
                    'user_id',
                    'created',
                    'modified',
                ],
            ]);
    }

    /**
     * @test
     * @group  feature
     * @group  feature:api
     * @group  feature:api:survey
     * @return void
     */
    public function a_user_cannot_retrieve_a_single_survey_owned_by_others()
    {
        // Arrangements
        Passport::actingAs($user = $this->asNonSuperAdmin(['surveys.show']), ['surveys.show']);
        $this->withPermissionsPolicy();

        $owned = factory(Survey::class, 5)->create(
            ['user_id' => $user->getKey()
        ])->random();
        $survey = factory(Survey::class, 5)->create()->random();

        // Actions
        $response = $this->get(route('api.surveys.show', $survey->getKey()));

        // Assertions
        $response->assertForbidden();
    }

    /**
     * @test
     * @group  feature
     * @group  feature:api
     * @group  feature:api:survey
     * @return void
     */
    public function a_user_can_only_update_an_owned_survey()
    {
        // Arrangements
        Passport::actingAs($user = $this->asNonSuperAdmin(['surveys.update']), ['surveys.update']);
        $this->withPermissionsPolicy();
        $survey = factory(Survey::class, 3)->create(['user_id' => $user->getKey()])->random();

        // Actions
        $attributes = factory(Survey::class)->make(['user_id' => $user->getKey()])->toArray();
        $response = $this->put(route('api.surveys.update', $survey->getKey()), $attributes);

        // Assertions
        $response->assertSuccessful();
        $this->assertDatabaseHas($survey->getTable(), $attributes);
    }

    /**
     * @test
     * @group  feature
     * @group  feature:api
     * @group  feature:api:survey
     * @return void
     */
    public function a_user_cannot_update_an_survey_owned_by_others()
    {
        // Arrangements
        Passport::actingAs($user = $this->asNonSuperAdmin(['surveys.update']), ['surveys.update']);
        $this->withPermissionsPolicy();

        $owned = factory(Survey::class, 5)->create([
            'user_id' => $user->getKey()
        ])->random();
        $survey = factory(Survey::class, 5)->create()->random();

        // Actions
        $attributes = factory(Survey::class)->make(['user_id' => $user->getKey()])->toArray();
        $response = $this->put(route('api.surveys.update', $survey->getKey()), $attributes);

        // Assertions
        $response->assertForbidden();
    }

    /**
     * @test
     * @group  feature
     * @group  feature:api
     * @group  feature:api:survey
     * @return void
     */
    public function a_user_can_only_soft_delete_an_owned_survey()
    {
        // Arrangements
        Passport::actingAs($user = $this->asNonSuperAdmin(['surveys.destroy']), ['surveys.destroy']);
        $this->withPermissionsPolicy();
        $survey = factory(Survey::class, 3)->create(['user_id' => $user->getKey()])->random();

        // Actions
        $response = $this->delete(route('api.surveys.destroy', $survey->getKey()));
        $survey = $this->service->withTrashed()->find($survey->getKey());

        // Assertions
        $response->assertSuccessful();
        $this->assertSoftDeleted($survey->getTable(), $survey->toArray());
    }

    /**
     * @test
     * @group  feature
     * @group  feature:api
     * @group  feature:api:survey
     * @return void
     */
    public function a_user_cannot_soft_delete_an_survey_owned_by_others()
    {
        // Arrangements
        Passport::actingAs($user = $this->asNonSuperAdmin(['surveys.destroy']), ['surveys.destroy']);
        $this->withPermissionsPolicy();
        $survey = factory(Survey::class, 3)->create()->random();

        // Actions
        $response = $this->delete(route('api.surveys.destroy', $survey->getKey()));
        $survey = $this->service->withTrashed()->find($survey->getKey());

        // Assertions
        $response->assertForbidden();
    }

    /**
     * @test
     * @group  feature
     * @group  feature:api
     * @group  feature:api:survey
     * @return void
     */
    public function a_user_can_only_soft_delete_multiple_owned_surveys()
    {
        // Arrangements
        Passport::actingAs($user = $this->asNonSuperAdmin(['surveys.destroy']), ['surveys.destroy']);
        $this->withPermissionsPolicy();
        $surveys = factory(Survey::class, 3)->create(['user_id' => $user->getKey()]);

        // Actions
        $attributes = ['id' => $surveys->pluck('id')->toArray()];
        $response = $this->delete(route('api.surveys.destroy', 'null'), $attributes);
        $surveys = $this->service->onlyTrashed();

        // Assertions
        $response->assertSuccessful();
        $surveys->each(function ($survey) {
            $this->assertSoftDeleted($survey->getTable(), $survey->toArray());
        });
    }

    /**
     * @test
     * @group  feature
     * @group  feature:api
     * @group  feature:api:survey
     * @return void
     */
    public function a_user_cannot_soft_delete_multiple_surveys_owned_by_others()
    {
        // Arrangements
        Passport::actingAs($user = $this->asNonSuperAdmin(['surveys.destroy']), ['surveys.destroy']);
        $this->withPermissionsPolicy();
        $surveys = factory(Survey::class, 3)->create();

        // Actions
        $attributes = ['id' => $surveys->pluck('id')->toArray()];
        $response = $this->delete(route('api.surveys.destroy', 'null'), $attributes);

        // Assertions
        $response->assertForbidden();
    }

    /**
     * @test
     * @group  feature
     * @group  feature:api
     * @group  feature:api:survey
     * @return void
     */
    public function a_user_can_only_retrieve_their_owned_paginated_list_of_trashed_surveys()
    {
        // Arrangements
        Passport::actingAs($user = $this->asNonSuperAdmin(['surveys.trashed']), ['surveys.trashed']);
        $this->withPermissionsPolicy();
        $surveys = factory(Survey::class, 2)->create(['user_id' => $user->getKey()]);
        $surveys->each->delete();

        // Actions
        $response = $this->get(route('api.surveys.trashed'));

        // Assertions
        $response
            ->assertSuccessful()
            ->assertJson(['data' => [['user_id' => $user->getKey()]]])
            ->assertJsonStructure([
                'data' => [[
                    'title',
                    'code',
                    'body',
                    'user_id',
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
     * @group  feature:api:survey
     * @return void
     */
    public function a_user_cannot_retrieve_the_paginated_list_of_trashed_surveys_owned_by_others()
    {
        // Arrangements
        Passport::actingAs($user = $this->asNonSuperAdmin(['surveys.trashed']), ['surveys.trashed']);
        $this->withPermissionsPolicy();

        $owned = factory(Survey::class, 5)->create(['user_id' => $user->getKey()]);
        $owned->each->delete();
        $surveys = factory(Survey::class, 5)->create();
        $surveys->each->delete();

        // Actions
        $response = $this->get(route('api.surveys.trashed'));

        // Assertions
        $response
            ->assertSuccessful()
            ->assertJson(['data' => $owned->toArray()])
            ->assertDontSee($surveys->random()->code)
            ->assertJsonMissing($surveys->toArray());
    }

    /**
     * @test
     * @group  feature
     * @group  feature:api
     * @group  feature:api:survey
     * @return void
     */
    public function a_user_can_only_restore_owned_destroyed_surveys()
    {
        // Arrangements
        Passport::actingAs($user = $this->asNonSuperAdmin(['surveys.restore']), ['surveys.restore']);
        $this->withPermissionsPolicy();
        $survey = factory(Survey::class, 3)->create(['user_id' => $user->getKey()])->random();
        $survey->delete();

        // Actions
        $response = $this->patch(route('api.surveys.restore', $survey->getKey()));
        $survey = $this->service->find($survey->getKey());

        // Assertions
        $response->assertSuccessful();
        $this->assertFalse($survey->trashed());
    }

    /**
     * @test
     * @group  feature
     * @group  feature:api
     * @group  feature:api:survey
     * @return void
     */
    public function a_user_cannot_restore_destroyed_surveys_owned_by_others()
    {
        // Arrangements
        Passport::actingAs($user = $this->asNonSuperAdmin(['surveys.restore']), ['surveys.restore']);
        $this->withPermissionsPolicy();
        $survey = factory(Survey::class, 3)->create()->random();
        $survey->delete();

        // Actions
        $response = $this->patch(route('api.surveys.restore', $survey->getKey()));
        $survey = $this->service->withTrashed()->find($survey->getKey());

        // Assertions
        $response->assertForbidden();
        $this->assertTrue($survey->trashed());
    }

    /**
     * @test
     * @group  feature
     * @group  feature:api
     * @group  feature:api:survey
     * @return void
     */
    public function a_user_can_only_restore_multiple_owned_destroyed_surveys()
    {
        // Arrangements
        Passport::actingAs($user = $this->asNonSuperAdmin(['surveys.restore']), ['surveys.restore']);
        $this->withPermissionsPolicy();
        $surveys = factory(Survey::class, 3)->create(['user_id' => $user->getKey()]);
        $surveys->each->delete();

        // Actions
        $attributes = ['id' => $surveys->pluck('id')->toArray()];
        $response = $this->patch(route('api.surveys.restore'), $attributes);
        $surveys = $this->service->whereIn('id', $attributes['id'])->get();

        // Assertions
        $response->assertSuccessful();
        $surveys->each(function ($survey) {
            $this->assertFalse($survey->trashed());
        });
    }

    /**
     * @test
     * @group  feature
     * @group  feature:api
     * @group  feature:api:survey
     * @return void
     */
    public function a_user_cannot_restore_multiple_destroyed_surveys_owned_by_others()
    {
        // Arrangements
        Passport::actingAs($user = $this->asNonSuperAdmin(['surveys.restore']), ['surveys.restore']);
        $this->withPermissionsPolicy();
        $surveys = factory(Survey::class, 3)->create();
        $surveys->each->delete();

        // Actions
        $attributes = ['id' => $surveys->pluck('id')->toArray()];
        $response = $this->patch(route('api.surveys.restore'), $attributes);
        $surveys = $this->service->withTrashed()->whereIn('id', $attributes['id'])->get();

        // Assertions
        $response->assertForbidden();
        $surveys->each(function ($survey) {
            $this->assertTrue($survey->trashed());
        });
    }

    /**
     * @test
     * @group  feature
     * @group  feature:api
     * @group  feature:api:survey
     * @return void
     */
    public function a_user_can_only_permanently_delete_an_owned_survey()
    {
        // Arrangements
        Passport::actingAs($user = $this->asNonSuperAdmin(['surveys.delete']), ['surveys.delete']);
        $this->withPermissionsPolicy();
        $survey = factory(Survey::class, 2)->create(['user_id' => $user->getKey()])->random();

        // Actions
        $response = $this->delete(route('api.surveys.delete', $survey->getKey()));

        // Assertions
        $response->assertSuccessful();
        $this->assertDatabaseMissing($survey->getTable(), $survey->toArray());
    }

    /**
     * @test
     * @group  feature
     * @group  feature:api
     * @group  feature:api:survey
     * @return void
     */
    public function a_user_cannot_permanently_delete_an_survey_owned_by_others()
    {
        // Arrangements
        Passport::actingAs($user = $this->asNonSuperAdmin(['surveys.delete']), ['surveys.delete']);
        $this->withPermissionsPolicy();
        $survey = factory(Survey::class, 2)->create()->random();

        // Actions
        $response = $this->delete(route('api.surveys.delete', $survey->getKey()));

        // Assertions
        $response->assertForbidden();
        $this->assertDatabaseHas($survey->getTable(), $survey->toArray());
    }

    /**
     * @test
     * @group  feature
     * @group  feature:api
     * @group  feature:api:survey
     * @return void
     */
    public function a_user_can_only_permanently_delete_multiple_owned_surveys()
    {
        // Arrangements
        Passport::actingAs($user = $this->asNonSuperAdmin(['surveys.delete']), ['surveys.delete']);
        $this->withPermissionsPolicy();
        $surveys = factory(Survey::class, 3)->create(['user_id' => $user->getKey()]);

        // Actions
        $attributes = ['id' => $surveys->pluck('id')->toArray()];
        $response = $this->delete(route('api.surveys.delete'), $attributes);

        // Assertions
        $response->assertSuccessful();
        $surveys->each(function ($survey) {
            $this->assertDatabaseMissing($survey->getTable(), $survey->toArray());
        });
    }

    /**
     * @test
     * @group  feature
     * @group  feature:api
     * @group  feature:api:survey
     * @return void
     */
    public function a_user_cannot_permanently_delete_multiple_surveys_owned_by_others()
    {
        // Arrangements
        Passport::actingAs($user = $this->asNonSuperAdmin(['surveys.delete']), ['surveys.delete']);
        $this->withPermissionsPolicy();
        $surveys = factory(Survey::class, 3)->create();

        // Actions
        $attributes = ['id' => $surveys->pluck('id')->toArray()];
        $response = $this->delete(route('api.surveys.delete'), $attributes);

        // Assertions
        $response->assertForbidden();
        $surveys->each(function ($survey) {
            $this->assertDatabaseHas($survey->getTable(), $survey->toArray());
        });
    }
}
