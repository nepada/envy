<?php
declare(strict_types = 1);

namespace Nepada\Envy\ValueProviders;

use Nepada\Envy\ValueProviderInterface;
use Nette\SmartObject;

final class SingleValueProvider implements ValueProviderInterface
{

    use SmartObject;

    /** @var mixed */
    private $value;

    /**
     * @param mixed $value
     */
    public function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * @param string $name
     * @return mixed
     */
    public function get(string $name)
    {
        return $this->value;
    }

}
