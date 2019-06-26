<?php

namespace Core\Console\Commands\Module;

use Core\Console\Commands\QualifyModule;
use Core\Support\Module\ModuleTrait;
use Illuminate\Foundation\Console\ObserverMakeCommand;
use Symfony\Component\Console\Input\InputOption;

class ModuleObserverCommand extends ObserverMakeCommand
{
    use ModuleTrait, QualifyModule;

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'module:observer';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new observer class';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Observer';

    /**
     * Execute the console command.
     *
     * @return bool|null
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function handle()
    {
        $this->qualifyModule();

        parent::handle();
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return array_merge(parent::getOptions(), [
            ['module', null, InputOption::VALUE_OPTIONAL, 'Generate a listener for the given module.'],
        ]);
    }
}
