<?php
declare(strict_types = 1);

namespace NepadaTests\Envy\Processors;

require_once __DIR__ . '/../../bootstrap.php';

use Nepada\Envy\Processors\ValidatorProcessor;
use Nepada\Envy\ValueProviders\SingleValueProvider;
use NepadaTests\TestCase;
use Nette\Utils\AssertionException;
use Tester\Assert;



/**
 * @testCase
 */
class ValidatorProcessorTest extends TestCase
{

	public function testValidationSuccess() : void
	{
		$processor = new ValidatorProcessor('string:1..');
		$value = 'lorem ipsum';
		Assert::same($value, $processor->process('foo', new SingleValueProvider($value)));
	}



	public function testValidationFailures() : void
	{
		$processor = new ValidatorProcessor('string:1..');
		Assert::exception(
			function () use ($processor) : void {
				$processor->process('foo', new SingleValueProvider(''));
			},
			AssertionException::class,
			"The foo expects to be string in range 1.., string '' given.",
		);
	}

}



(new ValidatorProcessorTest())->run();
