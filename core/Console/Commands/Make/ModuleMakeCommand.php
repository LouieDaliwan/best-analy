<?php

namespace Core\Console\Commands\Make;

use Core\Support\Module\ModuleTrait;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Composer;

class ModuleMakeCommand extends Command
{
    use ModuleTrait;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:module
                           {name : The name of the module}
                           {--extends= : Specify the module this module\'s controller, models, and such will extend to}
                           ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a new module';

    /**
     * The filesystem instance.
     *
     * @var \Illuminate\Filesystem\Filesystem
     */
    protected $files;

    /**
     * The Composer class instance.
     *
     * @var \Illuminate\Support\Composer
     */
    protected $composer;

    /**
     * Manifest file name.
     *
     * @var string
     */
    protected $manifestFileName = 'manifest.json';

    /**
     * Create a new command instance.
     *
     * @param  \Illuminate\Filesystem\Filesystem $files
     * @param  \Illuminate\Support\Composer      $composer
     * @return void
     */
    public function __construct(Filesystem $files, Composer $composer)
    {
        parent::__construct();

        $this->files = $files;
        $this->composer = $composer;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->generateFolders();

        $this->generateManifestFile();

        $this->generateConfigFiles();

        $this->generateModuleFiles();

        $this->composer->dumpAutoloads();
    }

    /**
     * Create module folder.
     *
     * @return void
     */
    protected function generateFolders()
    {
        $module = str_replace(' ', '', ucwords($this->argument('name')));

        $directories = [
            "$module/config",
            "$module/Http/Controllers",
            "$module/database/factories",
            "$module/database/migrations",
            "$module/database/seeds",
            "$module/Models",
            "$module/Observers",
            "$module/Providers",
            "$module/Services",
            "$module/Requests",
            "$module/routes",
            "$module/views/admin",
        ];

        foreach ($directories as $directory) {
            $this->files->makeDirectory($this->modulesPath($directory), 0755, true, true);
            $this->line(' - Directory created at <fg=green>'.$directory.'</>');
        }
    }

    /**
     * Generate manifest file.
     *
     * @return void
     */
    protected function generateManifestFile()
    {
        $this->files->put($this->getModuleDirectory(), $this->getManifestData());

        $this->callSilent('module:clear');
        $this->callSilent('module:discover');
    }

    /**
     * Generate config files:
     * - sidebar
     * - permissions
     *
     * @return void
     */
    protected function generateConfigFiles()
    {
        $this->call('make:config', [
            '--type' => 'sidebar',
            '--module' => $this->argument('name'),
            '--force' => true,
        ]);

        $this->call('make:config', [
            '--type' => 'permissions',
            '--module' => $this->argument('name'),
            '--force' => true,
        ]);
    }

    /**
     * Generate controller file.
     *
     * @return void
     */
    protected function generateModuleFiles()
    {
        $this->call('module:controller', [
            'name' => $this->argument('name').'Controller',
            '--module' => $this->argument('name'),
            '--admin' => true,
            '-n' => true,
        ]);

        $this->call('module:model', [
            'name' => 'Models/'.$this->argument('name'),
            '--module' => $this->argument('name'),
            '-n' => true,
        ]);

        $this->call('module:views', [
            '--module' => $this->argument('name'),
            '-n' => true,
        ]);

        $this->call('make:migration', [
            'name' => 'create_'.snake_case(str_plural($this->argument('name'))).'_table',
            '--module' => $this->argument('name'),
            '-n' => true,
        ]);

        $this->composer->dumpAutoloads();

        $this->call('module:observer', [
            'name' => $this->argument('name').'Observer',
            '--module' => $this->argument('name'),
            '-n' => true,
        ]);

        $this->call('module:provider', [
            'name' => $this->argument('name').'ServiceProvider',
            '--module' => $this->argument('name'),
            '-n' => true,
        ]);

        $this->call('make:service', [
            'name' => $this->argument('name').'Service',
            '--module' => $this->argument('name'),
            '-n' => true,
        ]);
    }

    /**
     * Retrieve the manifest data.
     *
     * @return string
     */
    protected function getManifestData()
    {
        $data = ['name' => $this->argument('name')];

        return preg_replace('/^(  +?)\\1(?=[^ ])/m', '$1', json_encode($data, JSON_PRETTY_PRINT));
    }

    /**
     * Retrieve the module path.
     *
     * @return string
     */
    protected function getModuleDirectory()
    {
        return $this->modulesPath($this->argument('name').DIRECTORY_SEPARATOR.$this->manifestFileName);
    }
}
