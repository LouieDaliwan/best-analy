<?php

namespace Customer\Jobs;

use Best\Jobs\UpdateGeneratedReport;
use Customer\Models\Customer;
use Customer\Services\FinancialRatioInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Survey\Models\Survey;

class UpdateStatementsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $customer;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Customer $customer)
    {
        $this->customer = $customer;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $statements = $this->customer->statements;
       
        
        foreach ($statements as $statement) {    
            app(FinancialRatioInterface::class)->compute($this->customer, $this->setArr($statement), $statement->period);   
        }

        $survey = Survey::find(1);
        dispatch(new UpdateGeneratedReport($survey, $this->customer));
    }

    protected function setArr($statement)
    {
        $metadataStatements = $statement->metadataStatements;
        $metadataStatements['period'] = $statement->period;

        return [
            'id' => $statement->id,
            'metadataStatements' => $metadataStatements,
            'metadataSheets' => $statement->metadataSheets,
        ];
    }
}
