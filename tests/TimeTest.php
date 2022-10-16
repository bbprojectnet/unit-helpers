<?php

use BBProjectNet\UnitHelpers\Time;
use PHPUnit\Framework\TestCase;

class TimeTest extends TestCase
{
	public function of_provider()
	{
		return [
			'zero' => [[0, 0, 0, 0, 0, 0, 0, 'seconds'], 0],
			'mixed units' => [[1, 2, 3, 4, 5, 6, 7, 'seconds'], 38898367],
		];
	}

	/**
	 * @dataProvider of_provider
	 */
	public function test_of($arguments, $expected): void
	{
		$result = Time::of(...$arguments);

		$this->assertSame($expected, $result);
	}
}
