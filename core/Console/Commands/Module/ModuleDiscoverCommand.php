<?php

namespace Core\Console\Commands\Module;

use Core\Manifests\ModuleManifest;
use Illuminate\Console\Command;

class ModuleDiscoverCommand extends Command
{
    /**
     * The console command signature.
     *
     * @var string
     */
    protected $signature = 'module:discover';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Rebuild the cached module manifest';

    /**
     * Execute the console command.
     *
     * @param  \Core\Manifests\ModuleManifest $manifest
     * @return void
     */
    public function handle(ModuleManifest $manifest)
    {
        $this->call('module:clear');

        $manifest->build();

        foreach ($manifest->modules()->pluck('name') ?? [] as $module) {
            $this->line("Discovered Module: <info>{$module}</info>");
        }

        $this->info('Module manifest generated successfully.');
    }
}
