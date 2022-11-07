<?php

namespace Core\Console\Commands;

use Carbon\Carbon;
use Customer\Models\Customer;
use Illuminate\Console\Command;

class CompanyCheckingTrashed extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'company:checked-trashed-monthly';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check the company was being trashed will permanently deleted';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        Customer::onlyTrashed()->each(function ($query) {

            $is_thirty_days_temp_delete = $query->deleted_at->addDays(30);

            $now = Carbon::now();

            if ($now->format('Y-m-d') == $is_thirty_days_temp_delete->format('Y-m-d') || $is_thirty_days_temp_delete->lt($now)) {
                $query->forceDelete();
            }
        });
    }
}
