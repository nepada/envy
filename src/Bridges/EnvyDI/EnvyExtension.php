<?php
declare(strict_types = 1);

namespace Nepada\Bridges\EnvyDI;

use Nepada\Envy\Envy;
use Nepada\Envy\LoaderFactory;
use Nepada\Envy\ValueProviders\Reader;
use Nette;
use Nette\DI\CompilerExtension;

class EnvyExtension extends CompilerExtension
{

    public function getConfigSchema(): Nette\Schema\Schema
    {
        return Nette\Schema\Expect::structure([]);
    }

    public function loadConfiguration(): void
    {
        $containerBuilder = $this->getContainerBuilder();

        $containerBuilder->addDefinition($this->prefix('reader'))
            ->setType(Reader::class);

        $containerBuilder->addDefinition($this->prefix('loaderFactory'))
            ->setType(LoaderFactory::class);

        $containerBuilder->addDefinition($this->prefix('envy'))
            ->setType(Envy::class);

        $containerBuilder->addAlias($this->name, $this->prefix('envy'));
    }

}
