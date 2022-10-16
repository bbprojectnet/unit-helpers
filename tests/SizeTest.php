<?php

use BBProjectNet\UnitHelpers\Size;
use PHPUnit\Framework\TestCase;

class SizeTest extends TestCase
{
	public function of_provider()
	{
		return [
			'zero' => [[0, 0, 0, 0, 0, 0, 'b'], 0],
			'mixed units' => [[1, 2, 3, 4, 5, 6, 'b'], 1128102155523078],
		];
	}

	/**
	 * @dataProvider of_provider
	 */
	public function test_of($arguments, $expected): void
	{
		$result = Size::of(...$arguments);

		$this->assertSame($expected, $result);
	}
}
