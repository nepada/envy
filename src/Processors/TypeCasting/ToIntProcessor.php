<?php
declare(strict_types = 1);

namespace Nepada\Envy\Processors\TypeCasting;

use Nepada\Envy\ProcessorInterface;
use Nepada\Envy\ValueProviderInterface;
use Nette\SmartObject;
use Nette\Utils\Validators;



final class ToIntProcessor implements ProcessorInterface
{

	use SmartObject;



	public function process(string $name, ValueProviderInterface $valueProvider) : int
	{
		$value = $valueProvider->get($name);
		Validators::assert($value, 'numericint', $name);
		return (int) $value;
	}

}
