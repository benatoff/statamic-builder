<?php

namespace Tdwesten\StatamicBuilder\Console;

use Illuminate\Console\GeneratorCommand as BaseGeneratorCommand;

class MakeFieldsetCommand extends BaseGeneratorCommand
{
    /**
     * @var string
     */
    protected $name = 'make:fieldset';

    /**
     * @var string
     */
    protected $description = 'Create a new Statamic Builder fieldset';

    /**
     * @var string
     */
    protected $type = 'Statamic Builder Fieldset';

    /**
     * {@inheritDoc}
     */
    protected function getStub()
    {
        return __DIR__.'/../../stubs/Fieldset.stub';
    }

    /**
     * {@inheritDoc}
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\\Fieldsets';
    }
}
