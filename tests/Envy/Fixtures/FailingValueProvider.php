<?php
declare(strict_types = 1);

namespace NepadaTests\Envy\Fixtures;

use Nepada\Envy\EnvironmentVariableNotFoundException;
use Nepada\Envy\ValueProviderInterface;
use Nette\SmartObject;

final class FailingValueProvider implements ValueProviderInterface
{

    use SmartObject;

    /** @var \Throwable|NULL */
    private $failureException;

    public function __construct(?\Throwable $failureException = null)
    {
        $this->failureException = $failureException;
    }

    /**
     * @param string $name
     * @return mixed
     */
    public function get(string $name)
    {
        if ($this->failureException !== null) {
            throw $this->failureException;
        }

        throw EnvironmentVariableNotFoundException::withName($name);
    }

}
