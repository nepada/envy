<?php
declare(strict_types = 1);

namespace Nepada\Envy\ValueProviders;

use Nepada\Envy\ProcessorInterface;
use Nepada\Envy\Processors\FallbackProcessor;
use Nepada\Envy\Processors\MultiProcessor;
use Nepada\Envy\Processors\ValidatorProcessor;
use Nepada\Envy\ValueProviderInterface;
use Nette\SmartObject;



final class Loader implements ValueProviderInterface
{

	use SmartObject;

	/**
	 * @var ValueProviderInterface
	 */
	private $valueProvider;

	/**
	 * @var MultiProcessor
	 */
	private $processor;



	public function __construct(ValueProviderInterface $valueProvider, ProcessorInterface ...$processors)
	{
		$this->valueProvider = $valueProvider;
		$this->processor = new MultiProcessor(...$processors);
	}



	public function withAddedProcessor(ProcessorInterface $processor) : Loader
	{
		$clone = clone $this;
		$clone->processor = $clone->processor->withAddedProcessor($processor);

		return $clone;
	}



	/**
	 * @param mixed $fallback
	 * @return Loader
	 */
	public function withFallback($fallback) : Loader
	{
		return $this->withAddedProcessor(new FallbackProcessor($fallback));
	}



	public function withValidator(string $type) : Loader
	{
		return $this->withAddedProcessor(new ValidatorProcessor($type));
	}



	/**
	 * @param string $name
	 * @return mixed
	 */
	public function get(string $name)
	{
		return $this->processor->process($name, $this->valueProvider);
	}

}
