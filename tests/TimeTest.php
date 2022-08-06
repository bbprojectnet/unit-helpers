<?php

use BBProjectNet\UnitHelpers\Time;
use PHPUnit\Framework\TestCase;

class TimeTest extends TestCase
{
	public function of_provider()
	{
		return [
			'zero' => [[0, 0, 0, 0, 0, 0, 'seconds'], 0],
			'zero as hours' => [[0, 0, 0, 0, 0, 0, 'hours'], 0],
			'mixed units' => [[1, 2, 4, 10, 5, 30, 'seconds'], 33127530],
			'mixed units as hours' => [[1, 2, 4, 10, 5, 30, 'hours'], 9202],
			'mixed units as days' => [[1, 2, 4, 10, 5, 30, 'days'], 383],
			'0.9 days as days' => [[0, 0, 0, 21, 0, 0, 'days'], 0],
			'negative value' => [[0, 0, 0, -2, 0, 0, 'seconds'], -7200],
			'mixed units with negative values' => [[0, 0, 4, -1, 3, -120, 'seconds'], 342060],
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

	public function test_of_with_invalid_as_value(): void
	{
		$this->expectException(InvalidArgumentException::class);

		Time::of(years: 200, as: 'centuries');
	}

	public function callStatic_provider()
	{
		return [
			'zero' => ['seconds', [0], 0],
			'zero as hours' => ['hours', [0], 0],
			'hours' => ['hours', [4], 14400],
			'hours as minutes' => ['hours', [2, 'minutes'], 120],
			'weeks as minutes' => ['weeks', [3, 'minutes'], 30240],
			'no arguments' => ['hours', [], 3600],
			'singular form' => ['day', [], 86400],
			'singular form with quantity' => ['day', [2], 172800],
		];
	}

	/**
	 * @dataProvider callStatic_provider
	 */
	public function test_callStatic($name, $arguments, $expected)
	{
		$result = Time::{$name}(...$arguments);

		$this->assertSame($expected, $result);
	}

	public function test_callStatic_with_invalid_name_value(): void
	{
		$this->expectException(Error::class);

		Time::centuries(4);
	}
}
