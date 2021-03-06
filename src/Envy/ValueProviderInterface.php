<?php
declare(strict_types = 1);

namespace Nepada\Envy;

interface ValueProviderInterface
{

    /**
     * @param string $name
     * @return mixed
     */
    public function get(string $name);

}
