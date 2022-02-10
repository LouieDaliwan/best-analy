<?php

namespace Customer\Jobs;

use Customer\Models\Customer;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Customer\Services\CustomerServiceInterface;

class ComputeFinancialRatio implements ShouldQueue
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
        $statements = $this->customer->statements()
        ->latest()
        ->take(3)
        ->get(['metadataStatements', 'metadataSheets'])->toArray();

        $sheets = collect([]);
        $info_statements = collect([]);

        foreach ($statements as $key => $value) {
            $sheets->push($value['metadataSheets']);
            $info_statements->push($value['metadataStatements']);
        }

        $sheetResults =  $this->computeValues($sheets->toArray());

        $infoStatementResults  = $this->computeValues($info_statements->toArray());
    }

    protected function computeValues($attributes)
    {
        $results = [];

        foreach ($attributes as $key => $value) {

            foreach($value as $childKey => $childValue) {

                if (collect(['period', 'Balance'])->intersect([$childKey])->isNotEmpty()) {
                    continue;
                }

                isset($results[$childKey]) ? : $results[$childKey] = 0;
                $results[$childKey] += (int) $value[$childKey] ?? '0';

            }
        }

        return $results;
    }
}
