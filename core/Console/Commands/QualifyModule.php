<?php

namespace Core\Console\Commands;

use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputOption;

trait QualifyModule
{
    /**
     * Get the module the file belongs to.
     *
     * @return string
     */
    protected function qualifyModule()
    {
        $this->callSilent('module:clear');
        $this->callSilent('module:discover');

        $module = $this->module($this->option('module'));

        if (! empty($this->option('module')) && is_null($module)) {
            $this->error("Module {$this->option('module')} not found!");
        }

        if (is_null($module) || ! $module) {
            $module = $this->module(
                $this->choice(
                    'Pick the module the file will belong',
                    $this->modules()->pluck('name')->toArray()
                )
            );
        }

        $this->input->setOption('module', $module['path']);

        return $this->input->getOption('module');
    }

    /**
     * Get the destination class path.
     *
     * @param  string $name
     * @param  string $withExtension
     * @return string
     */
    protected function getPath($name, $withExtension = true)
    {
        $name = Str::replaceFirst($this->rootNamespace(), '', $name);

        return $this->module['path'].'/'.str_replace('\\', '/', $name).($withExtension ? '.php' : null);
    }

    /**
     * Get the root namespace for the class.
     *
     * @return string
     */
    protected function rootNamespace()
    {
        return basename($this->option('module')).'\\';
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return array_merge(parent::getOptions(), [
            ['module', null, InputOption::VALUE_OPTIONAL, 'Specify the module the resource will belong to.'],
        ]);
    }
}
