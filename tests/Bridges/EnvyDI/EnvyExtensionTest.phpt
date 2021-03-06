<?php
declare(strict_types = 1);

namespace NepadaTests\Bridges\EnvyDI;

require_once __DIR__ . '/../../bootstrap.php';

use Nepada\Envy\Envy;
use Nepada\Envy\LoaderFactory;
use Nepada\Envy\ValueProviders\Reader;
use NepadaTests\Environment;
use NepadaTests\TestCase;
use Nette\Configurator;
use Nette\DI\Container;
use Tester\Assert;

/**
 * @testCase
 */
class EnvyExtensionTest extends TestCase
{

    protected function setUp(): void
    {
        parent::setUp();
        putenv('FOO=foo');
    }

    public function testServices(): void
    {
        $container = $this->createContainer();

        Assert::type(Envy::class, $container->getService('envy'));
        Assert::type(Envy::class, $container->getService('envy.envy'));
        Assert::type(Reader::class, $container->getService('envy.reader'));
        Assert::type(LoaderFactory::class, $container->getService('envy.loaderFactory'));
    }

    public function testParameters(): void
    {
        $container = $this->createContainer();
        Assert::same(
            [
                'foo' => 'foo',
                'bar' => 'default',
                'baz' => null,
            ],
            (array) $container->getService('env'),
        );
    }

    private function createContainer(): Container
    {
        $configurator = new Configurator();
        $configurator->setDebugMode(false);
        $configurator->setTempDirectory(Environment::getTempDir());
        $configurator->addConfig(__DIR__ . '/config.neon');

        return $configurator->createContainer();
    }

}



(new EnvyExtensionTest())->run();
