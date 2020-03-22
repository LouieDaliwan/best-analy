<?php

namespace Survey\Feature\Api;

use Customer\Models\Customer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Passport\Passport;
use Survey\Models\Field;
use Survey\Models\Submission;
use Survey\Services\SubmissionServiceInterface;
use Tests\ActingAsUser;
use Tests\TestCase;
use Tests\WithPermissionsPolicy;

/**
 * @package Survey\Feature\Api
 * @runTestsInSeparateProcesses
 * @preserveGlobalState disabled
 */
class SubmissionsTest extends TestCase
{
    use RefreshDatabase, WithFaker, ActingAsUser, WithPermissionsPolicy;

    /** Set up the service class */
    public function setUp(): void
    {
        parent::setUp();

        $this->service = $this->app->make(SubmissionServiceInterface::class);
    }

    /**
     * @test
     * @group  feature
     * @group  feature:api
     * @group  feature:api:submission
     * @return void
     */
    public function a_user_can_store_a_field_submission_to_database()
    {
        // Arrangements
        $this->withoutExceptionHandling();
        Passport::actingAs($user = $this->asNonSuperAdmin(['submissions.store']), ['submissions.store']);
        $this->withPermissionsPolicy();

        // Actions
        $customer = factory(Customer::class)->create();
        foreach (factory(Field::class,2)->create() as $field) {
            $submissions[$field->getKey()] = factory(Submission::class)->make([
                'user_id' => $user->getKey(),
                'submissible_id' => $field->getKey(),
                'submissible_type' => get_class($field),
                'customer_id' => $customer->getKey(),
            ])->toArray();
        }

        $response = $this->post(route('api.submissions.store'), $submissions);

        // Assertions
        $response->assertSuccessful();
        collect($submissions)->each(function ($submission) {
            $this->assertDatabaseHas($this->service->getTable(), collect($submission)->except(
                'results',
                'remarks',
                'metadata',
                'submissible_id',
                'submissible_type',
                'user_id',
            )->toArray());
        });
    }

    /**
     * @test
     * @group  feature
     * @group  feature:api
     * @group  feature:api:submission
     * @return void
     */
    public function a_user_can_only_retrieve_an_owned_single_field_submission()
    {
        // Arrangements
        Passport::actingAs($user = $this->asNonSuperAdmin(['submissions.show']), ['submissions.show']);
        $this->withPermissionsPolicy();
        $submission = factory(Submission::class, 2)->create(['user_id' => $user->getKey()])->random();

        // Actions
        $response = $this->get(route('api.submissions.show', $submission->getKey()));

        // Assertions
        $response
            ->assertSuccessful()
            ->assertJson(['data' => ['user_id' => $user->getKey()]])
            ->assertJsonStructure([
                'data' => [
                    'results',
                    'remarks',
                    'metadata',
                    'submissible_id',
                    'submissible_type',
                    'user_id',
                    'created',
                ],
            ]);
    }

    /**
     * @test
     * @group  feature
     * @group  feature:api
     * @group  feature:api:submission
     * @return void
     */
    public function a_user_cannot_retrieve_a_single_field_submission_owned_by_others()
    {
        // Arrangements
        Passport::actingAs($user = $this->asNonSuperAdmin(['submissions.show']), ['submissions.show']);
        $this->withPermissionsPolicy();

        $owned = factory(Submission::class, 2)->create(['user_id' => $user->getKey()])->random();
        $submission = factory(Submission::class, 2)->create()->random();

        // Actions
        $response = $this->get(route('api.submissions.show', $submission->getKey()));

        // Assertions
        $response
            ->assertForbidden();
    }

    /**
     * @test
     * @group  feature
     * @group  feature:api
     * @group  feature:api:submission
     * @return void
     */
    public function a_user_can_only_retrieve_their_owned_paginated_list_of_field_submission()
    {
        // Arrangements
        Passport::actingAs($user = $this->asNonSuperAdmin(['submissions.index']), ['submissions.index']);
        $this->withPermissionsPolicy();

        $submission = factory(Submission::class, 2)->create(['user_id' => $user->getKey()]);

        // Actions
        $response = $this->get(route('api.submissions.index'));

        // Assertions
        $response
            ->assertSuccessful()
            ->assertJson(['data' => [['user_id' => $user->getKey()]]])
            ->assertJsonStructure([
                'data' => [[
                    'results',
                    'remarks',
                    'metadata',
                    'submissible_id',
                    'submissible_type',
                    'user_id',
                    'created',
                ]],
            ]);
    }

    /**
     * @test
     * @group  feature
     * @group  feature:api
     * @group  feature:api:submission
     * @return void
     */
    public function a_user_cannot_retrieve_the_paginated_list_of_field_submission_owned_by_others()
    {
        // Arrangements
        Passport::actingAs($user = $this->asNonSuperAdmin(['submissions.index']), ['submissions.index']);
        $this->withPermissionsPolicy();

        $owned = factory(Submission::class, 2)->create(['user_id' => $user->getKey()]);
        $submission = factory(Submission::class, 2)->create();

        // Actions
        $response = $this->get(route('api.submissions.index'));

        // Assertions
        $response
            ->assertSuccessful()
            ->assertJson(['data' => $owned->toArray()])
            ->assertDontSee($submission->random())
            ->assertJsonMissing($submission->toArray());
    }

    /**
     * @test
     * @group  feature
     * @group  feature:api
     * @group  feature:api:submission
     * @return void
     */
    public function a_user_can_only_destroy_a_submission()
    {
        // Arrangements
        $this->withoutExceptionHandling();
        Passport::actingAs($user = $this->asNonSuperAdmin(['submissions.destroy']), ['submissions.destroy']);
        $this->withPermissionsPolicy();
        $submission = factory(Submission::class, 2)->create([
            'user_id' => $user->getKey(),
            'metadata' => null,
        ])->random();

        // Actions
        $response = $this->delete(route('api.submissions.destroy', $submission->getKey()));

        // Assertions
        $response->assertSuccessful();
        $this->assertDatabaseMissing($submission->getTable(), $submission->toArray());
    }

    /**
     * @test
     * @group  feature
     * @group  feature:api
     * @group  feature:api:submission
     * @return void
     */
    public function a_user_can_only_multiple_destroy_submissions()
    {
        // Arrangements
        Passport::actingAs($user = $this->asNonSuperAdmin(['submissions.destroy']), ['submissions.destroy']);
        $this->withPermissionsPolicy();
        $submissions = factory(Submission::class, 3)->create([
            'user_id' => $user->getKey(),
            'metadata' => null,
        ]);

        // Actions
        $attributes = ['id' => $submissions->pluck('id')->toArray()];
        $response = $this->delete(route('api.submissions.destroy', 'null'), $attributes);

        // Assertions
        $response->assertSuccessful();
        $submissions->each(function ($submission) {
            $this->assertDatabaseMissing($submission->getTable(), $submission->toArray());
        });
    }
}
