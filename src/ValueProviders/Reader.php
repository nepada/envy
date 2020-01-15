<?php
declare(strict_types = 1);

namespace Nepada\Envy\ValueProviders;

use Nepada\Envy\EnvironmentVariableNotFoundException;
use Nepada\Envy\ValueProviderInterface;
use Nette\SmartObject;

final class Reader implements ValueProviderInterface
{

    use SmartObject;

    public function exists(string $name): bool
    {
        try {
            self::get($name);
            return true;

        } catch (EnvironmentVariableNotFoundException $exception) {
            return false;
        }
    }

    public function get(string $name): string
    {
        $value = getenv($name, true);
        if ($value === false) {
            throw EnvironmentVariableNotFoundException::withName($name);
        }

        return $value;
    }

}
