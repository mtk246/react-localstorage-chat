<?php

declare(strict_types=1);

namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;

final class CreateRequestCast extends GeneratorCommand
{
    /** @var string */
    protected $signature = 'make:request-cast {name}';

    /** @var string */
    protected $description = 'Create a new form request cast class';

    /** @var string */
    protected $type = 'Request Cast';

    public function handle(): void
    {
        parent::handle();
    }

    protected function getStub(): string
    {
        return base_path().'/stubs/request.casts.stub';
    }

    /**
     * Get the default namespace for the class.
     *
     * @param string $rootNamespace
     *
     * @phpcs:disable
     */
    protected function getDefaultNamespace($rootNamespace): string
    {
        return $rootNamespace.'\Http\Casts';
    }
}
