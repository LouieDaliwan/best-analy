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
use User\Models\User;

class UpdateGeneratedReport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $customer;

    protected $survey;

    protected $user;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Survey $survey, Customer $customer, User $user)
    {
        $this->survey = $survey;
        $this->customer= $customer;
        $this->user = $user;
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

        logger('Proceed on Formula Generate');
        app(FormulaServiceInterface::class)->generate($this->survey, $attributes, null, $this->user);
    }
}
