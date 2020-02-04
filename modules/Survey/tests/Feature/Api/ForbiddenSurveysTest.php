<?php

namespace Survey\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Passport\Passport;
use Survey\Models\Survey;
use Survey\Services\SurveyServiceInterface;
use Tests\ActingAsUser;
use Tests\TestCase;
use Tests\WithPermissionsPolicy;

/**
 * @package Survey\Feature\Api
 * @runTestsInSeparateProcesses
 * @preserveGlobalState disabled
 */
class ForbiddenSurveysTest extends TestCase
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
     * @group  feature:api:survey:forbidden
     * @return void
     */
    public function an_unpermitted_user_cannot_retrieve_the_paginated_list_of_all_surveys()
    {
        // Arrangements
        Passport::actingAs($this->asNonSuperAdmin(['wrong-permission']), ['wrong-permission']);
        $this->withPermissionsPolicy();

        // Actions
        $response = $this->get(route('api.surveys.index'));

        // Assertions
        $response->assertForbidden();
    }

    /**
     * @test
     * @group  feature
     * @group  feature:api
     * @group  feature:api:survey
     * @group  feature:api:survey:forbidden
     * @return void
     */
    public function an_unpermitted_user_cannot_store_an_survey_to_database()
    {
        // Arrangements
        Passport::actingAs($this->asNonSuperAdmin(['wrong-permission']), ['wrong-permission']);
        $this->withPermissionsPolicy();

        // Actions
        $attributes = factory(Survey::class)->make()->toArray();
        $response = $this->post(route('api.surveys.store'), $attributes);

        // Assertions
        $response->assertForbidden();
    }

    /**
     * @test
     * @group  feature
     * @group  feature:api
     * @group  feature:api:survey
     * @group  feature:api:survey:forbidden
     * @return void
     */
    public function an_unpermitted_user_cannot_retrieve_a_single_survey()
    {
        // Arrangements
        Passport::actingAs($this->asNonSuperAdmin(['wrong-permission']), ['wrong-permission']);
        $this->withPermissionsPolicy();
        $survey = factory(Survey::class, 2)->create()->random();

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
     * @group  feature:api:survey:forbidden
     * @return void
     */
    public function an_unpermitted_user_cannot_update_an_survey()
    {
        // Arrangements
        Passport::actingAs($this->asNonSuperAdmin(['wrong-permission']), ['wrong-permission']);
        $this->withPermissionsPolicy();
        $survey = factory(Survey::class, 2)->create()->random();

        // Actions
        $attributes = factory(Survey::class)->make()->toArray();
        $response = $this->put(route('api.surveys.update', $survey->getKey()), $attributes);

        // Assertions
        $response->assertForbidden();
    }

    /**
     * @test
     * @group  feature
     * @group  feature:api
     * @group  feature:api:survey
     * @group  feature:api:survey:forbidden
     * @return void
     */
    public function an_unpermitted_user_cannot_soft_delete_an_survey()
    {
        // Arrangements
        Passport::actingAs($this->asNonSuperAdmin(['wrong-permission']), ['wrong-permission']);
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
     * @group  feature:api:survey:forbidden
     * @return void
     */
    public function an_unpermitted_user_cannot_soft_delete_multiple_surveys()
    {
        // Arrangements
        Passport::actingAs($this->asNonSuperAdmin(['wrong-permission']), ['wrong-permission']);
        $this->withPermissionsPolicy();
        $surveys = factory(Survey::class, 3)->create();

        // Actions
        $attributes = ['id' => $surveys->pluck('id')->toArray()];
        $response = $this->delete(route('api.surveys.destroy', 'null'), $attributes);
        $surveys = $this->service->onlyTrashed();

        // Assertions
        $response->assertForbidden();
    }

    /**
     * @test
     * @group  feature
     * @group  feature:api
     * @group  feature:api:survey
     * @group  feature:api:survey:forbidden
     * @return void
     */
    public function an_unpermitted_user_cannot_retrieve_the_paginated_list_of_all_trashed_surveys()
    {
        // Arrangements
        Passport::actingAs($this->asNonSuperAdmin(['wrong-permission']), ['wrong-permission']);
        $this->withPermissionsPolicy();
        $surveys = factory(Survey::class, 2)->create();
        $surveys->each->delete();

        // Actions
        $response = $this->get(route('api.surveys.trashed'));

        // Arrangements
        $response->assertForbidden();
    }

    /**
     * @test
     * @group  feature
     * @group  feature:api
     * @group  feature:api:survey
     * @group  feature:api:survey:forbidden
     * @return void
     */
    public function an_unpermitted_user_cannot_restore_destroyed_surveys()
    {
        // Arrangements
        Passport::actingAs($this->asNonSuperAdmin(['wrong-permission']), ['wrong-permission']);
        $this->withPermissionsPolicy();
        $survey = factory(Survey::class, 3)->create()->random();
        $survey->delete();

        // Actions
        $response = $this->patch(route('api.surveys.restore', $survey->getKey()));

        // Assertions
        $response->assertForbidden();
    }

    /**
     * @test
     * @group  feature
     * @group  feature:api
     * @group  feature:api:survey
     * @group  feature:api:survey:forbidden
     * @return void
     */
    public function an_unpermitted_user_cannot_restore_multiple_destroyed_surveys()
    {
        // Arrangements
        Passport::actingAs($this->asNonSuperAdmin(['wrong-permission']), ['wrong-permission']);
        $this->withPermissionsPolicy();
        $surveys = factory(Survey::class, 3)->create();
        $surveys->each->delete();

        // Actions
        $attributes = ['id' => $surveys->pluck('id')->toArray()];
        $response = $this->patch(route('api.surveys.restore'), $attributes);

        // Assertions
        $response->assertForbidden();
    }

    /**
     * @test
     * @group  feature
     * @group  feature:api
     * @group  feature:api:survey
     * @group  feature:api:survey:forbidden
     * @return void
     */
    public function an_unpermitted_user_cannot_permanently_delete_an_survey()
    {
        // Arrangements
        Passport::actingAs($this->asNonSuperAdmin(['wrong-permission']), ['wrong-permission']);
        $this->withPermissionsPolicy();
        $survey = factory(Survey::class, 2)->create()->random();

        // Actions
        $response = $this->delete(route('api.surveys.delete', $survey->getKey()));

        // Assertions
        $response->assertForbidden();
    }

    /**
     * @test
     * @group  feature
     * @group  feature:api
     * @group  feature:api:survey
     * @group  feature:api:survey:forbidden
     * @return void
     */
    public function an_unpermitted_user_cannot_permanently_delete_multiple_surveys()
    {
        // Arrangements
        Passport::actingAs($this->asNonSuperAdmin(['wrong-permission']), ['wrong-permission']);
        $this->withPermissionsPolicy();
        $surveys = factory(Survey::class, 3)->create();

        // Actions
        $attributes = ['id' => $surveys->pluck('id')->toArray()];
        $response = $this->delete(route('api.surveys.delete'), $attributes);

        // Assertions
        $response->assertForbidden();
    }
}
