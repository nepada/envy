<?php
declare(strict_types = 1);

namespace Nepada\Envy;

use Nepada\Envy\Processors\TypeCasting\ArrayProcessor;
use Nepada\Envy\Processors\TypeCasting\ToBoolProcessor;
use Nepada\Envy\Processors\TypeCasting\ToFloatProcessor;
use Nepada\Envy\Processors\TypeCasting\ToIntProcessor;
use Nepada\Envy\ValueProviders\Loader;
use Nepada\Envy\ValueProviders\Reader;
use Nette\SmartObject;



final class LoaderFactory
{

	use SmartObject;

	/**
	 * @var Reader
	 */
	private $reader;



	public function __construct(Reader $reader)
	{
		$this->reader = $reader;
	}



	public function create(ProcessorInterface ...$processors) : Loader
	{
		return new Loader($this->reader, ...$processors);
	}



	public function createBoolLoader() : Loader
	{
		return $this->create(new ToBoolProcessor());
	}



	public function createIntLoader() : Loader
	{
		return $this->create(new ToIntProcessor());
	}



	public function createFloatLoader() : Loader
	{
		return $this->create(new ToFloatProcessor());
	}



	public function createArrayLoader(string $delimiter = ArrayProcessor::DEFAULT_DELIMITER) : Loader
	{
		return $this->create(new ArrayProcessor($delimiter));
	}



	public function createIntArrayLoader(string $delimiter = ArrayProcessor::DEFAULT_DELIMITER) : Loader
	{
		return $this->create(new ArrayProcessor($delimiter, new ToIntProcessor()));
	}



	public function createFloatArrayLoader(string $delimiter = ArrayProcessor::DEFAULT_DELIMITER) : Loader
	{
		return $this->create(new ArrayProcessor($delimiter, new ToFloatProcessor()));
	}

}
