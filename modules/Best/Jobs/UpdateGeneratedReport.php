<?php

namespace Best\Jobs;

use Best\Services\FormulaServiceInterface;
use Customer\Models\Customer;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Survey\Models\Survey;

class UpdateGeneratedReport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $customer;

    protected $survey;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Survey $survey, Customer $customer)
    {
        $this->survey = $survey;
        $this->customer= $customer;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $attributes = [
            'customer_id' => $this->customer->id,
            'month' => date('Y-m-d H:i:s'),
        ];

        $data = app(FormulaServiceInterface::class)->generate($this->survey, $attributes);
    }
}
