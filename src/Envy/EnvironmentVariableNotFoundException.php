<?php
declare(strict_types = 1);

namespace Nepada\Envy;

class EnvironmentVariableNotFoundException extends \InvalidArgumentException
{

    public static function withName(string $name): EnvironmentVariableNotFoundException
    {
        return new EnvironmentVariableNotFoundException("Environment variable '$name' not found.");
    }

}
