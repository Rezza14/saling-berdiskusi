<?php

namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Contracts\Filesystem\FileNotFoundException;

class ServiceLayerCommand extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:service-layer {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a service layer for controller';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Service Layer';

    /**
     * Execute the console command.
     *
     * @return bool|void
     *
     * @throws FileNotFoundException
     */
    public function handle()
    {
        if (parent::handle() == false) {
            return false;
        }
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub(): string
    {
        return $this->resolveStubPath('/stubs/service-layer.stub');
    }

    /**
     * Resolve the fully-qualified path to the stub.
     *
     * @param  string  $stub
     * @return string
     */
    protected function resolveStubPath(string $stub): string
    {
        return file_exists($customPath = $this->laravel->basePath(trim($stub, '/')))
            ? $customPath
            : __DIR__.$stub;
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace): string
    {
        return is_dir(app_path('Services')) ? $rootNamespace.'\\Services' : $rootNamespace;
    }
}
