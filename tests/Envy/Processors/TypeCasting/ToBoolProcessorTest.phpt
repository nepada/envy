<?php
declare(strict_types = 1);

namespace NepadaTests\Envy\Processors\TypeCasting;

require_once __DIR__ . '/../../../bootstrap.php';

use Nepada\Envy\Processors\TypeCasting\ToBoolProcessor;
use Nepada\Envy\ValueProviders\SingleValueProvider;
use NepadaTests\TestCase;
use Nette\Utils\AssertionException;
use Tester\Assert;

/**
 * @testCase
 */
class ToBoolProcessorTest extends TestCase
{

    /**
     * @dataProvider getValidData
     * @param mixed $input
     * @param bool $output
     */
    public function testValidConversion($input, bool $output): void
    {
        $processor = new ToBoolProcessor();
        Assert::same($output, $processor->process('foo', new SingleValueProvider($input)));
    }

    /**
     * @return mixed[]
     */
    protected function getValidData(): array
    {
        return [
            [
                'input' => true,
                'output' => true,
            ],
            [
                'input' => false,
                'output' => false,
            ],
            [
                'input' => 'true',
                'output' => true,
            ],
            [
                'input' => 'false',
                'output' => false,
            ],
            [
                'input' => 'yes',
                'output' => true,
            ],
            [
                'input' => 'no',
                'output' => false,
            ],
            [
                'input' => '1',
                'output' => true,
            ],
            [
                'input' => '0',
                'output' => false,
            ],
            [
                'input' => 'tRUe',
                'output' => true,
            ],
            [
                'input' => 'fALSe',
                'output' => false,
            ],
        ];
    }

    /**
     * @dataProvider getInvalidData
     * @param mixed $input
     */
    public function testInvalidConversion($input): void
    {
        $processor = new ToBoolProcessor();
        Assert::exception(
            function () use ($processor, $input): void {
                $processor->process('foo', new SingleValueProvider($input));
            },
            AssertionException::class,
        );
    }

    /**
     * @return mixed[]
     */
    protected function getInvalidData(): array
    {
        return [
            ['input' => ''],
            ['input' => 'bflmpsvz'],
            ['input' => 42],
            ['input' => 3.1415],
            ['input' => null],
        ];
    }

}



(new ToBoolProcessorTest())->run();
