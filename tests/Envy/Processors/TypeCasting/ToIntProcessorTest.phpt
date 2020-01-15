<?php
declare(strict_types = 1);

namespace NepadaTests\Envy\Processors\TypeCasting;

require_once __DIR__ . '/../../../bootstrap.php';

use Nepada\Envy\Processors\TypeCasting\ToIntProcessor;
use Nepada\Envy\ValueProviders\SingleValueProvider;
use NepadaTests\TestCase;
use Nette\Utils\AssertionException;
use Tester\Assert;

/**
 * @testCase
 */
class ToIntProcessorTest extends TestCase
{

    /**
     * @dataProvider getValidData
     * @param mixed $input
     * @param int $output
     */
    public function testValidConversion($input, int $output): void
    {
        $processor = new ToIntProcessor();
        Assert::equal($output, $processor->process('foo', new SingleValueProvider($input)));
    }

    /**
     * @return mixed[]
     */
    protected function getValidData(): array
    {
        return [
            [
                'input' => 42,
                'output' => 42,
            ],
            [
                'input' => '-42',
                'output' => -42,
            ],
            [
                'input' => '50',
                'output' => 50,
            ],
        ];
    }

    /**
     * @dataProvider getInvalidData
     * @param mixed $input
     */
    public function testInvalidConversion($input): void
    {
        $processor = new ToIntProcessor();
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
            ['input' => 3.141_5],
            ['input' => null],
        ];
    }

}



(new ToIntProcessorTest())->run();
