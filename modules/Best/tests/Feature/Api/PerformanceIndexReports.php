<?php

namespace Best\Feature\Api;

use Best\Models\Report;
use Best\Services\ReportServiceInterface;
use Customer\Models\Customer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Index\Models\Index;
use Laravel\Passport\Passport;
use Survey\Models\Field;
use Survey\Models\Submission;
use Survey\Models\Survey;
use Tests\ActingAsUser;
use Tests\TestCase;
use Tests\WithPermissionsPolicy;

/**
 * @package Best\Feature\Api
 * @runTestsInSeparateProcesses
 * @preserveGlobalState disabled
 */
class PerformanceIndexReportsTest extends TestCase
{
    use RefreshDatabase, WithFaker, ActingAsUser, WithPermissionsPolicy;

    /** Set up the service class */
    public function setUp(): void
    {
        parent::setUp();

        $this->service = $this->app->make(ReportServiceInterface::class);
    }

    /**
     * @return void
     */
    public function a_user_can_generate_a_report_from_performance_index_of_customer()
    {
        // Arrangements
        Passport::actingAs($user = $this->asNonSuperAdmin(['surveys.report']), ['surveys.report']);
        $this->withPermissionsPolicy();

        $taxonomy = factory(Index::class)->create();
        $customer = factory(Customer::class, 2)->create()->random();
        $customer->indices()->sync($taxonomy->getKey());

        $survey = factory(Survey::class)->create();
        $fields = factory(Field::class, 5)->create([
            'form_id' => $survey->getKey(),
        ]);
        $fields->each(function ($field) use ($customer, $user) {
            factory(Submission::class)->create([
                'submissible_type' => get_class($field),
                'submissible_id' => $field->getKey(),
                'user_id' => $user->getKey(),
                'customer_id' => $customer->getKey(),
                'metadata' => json_encode([
                    'subscore' =>  $this->faker->randomDigitNotNull(),
                    'average' =>  $this->faker->randomDigitNotNull(),
                ]),
            ]);
        });
        $submissions = Submission::all();
        $submissions->each(function ($submission) use ($survey, $customer, $taxonomy) {
            factory(Report::class)->create([
                'group' => $this->faker->randomElement($this->faker->words($nb = 2)),
                'reportable_type' => get_class($submission),
                'reportable_id' => $submission->getKey(),
                'form_id' => $survey->getKey(),
                'customer_id' => $customer->getKey(),
                'taxonomy_id' => $taxonomy->getKey(),
            ]);
        });

        // Actions
        $attributes = [
            'filename' => $filename = sprintf('%s.%s', $this->faker->word(), $this->faker->fileExtension()),
            'customer_id' => $customer->getKey(),
            'taxonomy_id' => $taxonomy->getKey(),
        ];
        $response = $this->post(route('api.surveys.report', $survey->getKey()), $attributes);

        // Assertions
        $response->assertSuccessful();
    }
}
