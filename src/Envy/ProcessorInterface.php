<?php
declare(strict_types = 1);

namespace Nepada\Envy;

interface ProcessorInterface
{

    /**
     * @param string $name
     * @param ValueProviderInterface $valueProvider
     * @return mixed
     */
    public function process(string $name, ValueProviderInterface $valueProvider);

}
