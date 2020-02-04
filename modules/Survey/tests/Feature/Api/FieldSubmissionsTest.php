<?php

namespace Survey\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Passport\Passport;
use Survey\Models\Field;
use Survey\Models\Submission;
use Survey\Models\Survey;
use Survey\Services\SubmissionServiceInterface;
use Tests\ActingAsUser;
use Tests\TestCase;
use Tests\WithPermissionsPolicy;

/**
 * @package Survey\Feature\Api
 * @runTestsInSeparateProcesses
 * @preserveGlobalState disabled
 */
class FieldSubmissionsTest extends TestCase
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
     * @group  feature:api:field
     * @group  feature:api:field:submission
     * @return void
     */
    public function a_user_can_submit_their_answer_to_the_survey()
    {
        // Arrangements
        Passport::actingAs($user = $this->asNonSuperAdmin(['surveys.submit']), ['surveys.submit']);
        $this->withPermissionsPolicy();

        $survey = factory(Survey::class)->create();
        $fields = factory(Field::class, 5)->create(['form_id' => $survey->getKey()]);

        // Actions
        $attributes = ['fields' => $fields->map(function ($field) use ($user) {
            return [
                'id' => $field->getKey(),
                'submission' => factory(Submission::class)->make([
                    'user_id' => $user->getKey(),
                    'submissible_id' => null,
                    'submissible_type' => null,
                ])->toArray(),
            ];
        })->toArray()];

        $response = $this->post(route('api.surveys.submit', $survey->getKey()), $attributes);
        $submissions = collect($attributes['fields'])->map(function ($field) {
            return collect($field['submission'])->except(['submissible_id', 'submissible_type']);
        });

        // Assertions
        $response->assertSuccessful();
        $submissions->each(function ($submission) {
            $this->assertDatabaseHas($this->service->getTable(), $submission->toArray());
        });
    }
}
