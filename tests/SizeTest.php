<?php

use BBProjectNet\UnitHelpers\Size;
use PHPUnit\Framework\TestCase;

class SizeTest extends TestCase
{
	public function of_provider()
	{
		return [
			'zero' => [[0, 0, 0, 0, 0, 'b'], 0],
			'zero as megabytes' => [[0, 0, 0, 0, 0, 'mb'], 0],
			'mixed units' => [[1, 3, 20, 8, 2, 'b'], 1102753832962],
			'mixed units as kilobytes' => [[1, 3, 20, 8, 2, 'kb'], 1076908040],
			'mixed units as gigabytes' => [[1, 3, 20, 8, 2, 'gb'], 1027],
			'0.9 megabytes as megabytes' => [[0, 0, 0, 920, 0, 'mb'], 0],
			'negative value' => [[0, 0, 0, -2, 0, 'b'], -2048],
			'mixed units with negative values' => [[0, 0, 1, -2, 0, 'b'], 1046528],
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

	public function test_of_with_invalid_as_value(): void
	{
		$this->expectException(InvalidArgumentException::class);

		Size::of(kb: 200, as: 'xb');
	}

	public function callStatic_provider()
	{
		return [
			'zero' => ['b', [0], 0],
			'zero as kilobytes' => ['kb', [0], 0],
			'kilobytes' => ['kb', [4], 4096],
			'megabytes as kilobytes' => ['mb', [2, 'kb'], 2048],
			'terabytes as kilobytes' => ['tb', [3, 'kb'], 3221225472],
			'no arguments' => ['mb', [], 1048576],
		];
	}

	/**
	 * @dataProvider callStatic_provider
	 */
	public function test_callStatic($name, $arguments, $expected)
	{
		$result = Size::{$name}(...$arguments);

		$this->assertSame($expected, $result);
	}

	public function test_callStatic_with_invalid_name_value(): void
	{
		$this->expectException(Error::class);

		Size::xb(200);
	}
}
