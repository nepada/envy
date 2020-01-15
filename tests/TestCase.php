<?php
declare(strict_types = 1);

namespace NepadaTests;

use Tester;



abstract class TestCase extends Tester\TestCase
{

	public function run() : void
	{
		if ($_ENV['IS_PHPSTAN'] ?? FALSE) {
			return;
		}
		parent::run();
	}

}
