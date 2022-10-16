<?php

use BBProjectNet\UnitHelpers\Unit;
use PHPUnit\Framework\TestCase;

class UnitTest extends TestCase
{
	protected $unit;

	/**
	 * @inheritDoc
	 */
	protected function setUp(): void
	{
		parent::setUp();

		$this->unit = new class () extends Unit {
			public static function __transform(array $values, string $as): int
			{
				return self::transform($values, $as);
			}

			protected static function getUnits(): array
			{
				return [
					'f' => 32,
					'e' => 16,
					'd' => 8,
					'c' => 4,
					'b' => 2,
					'a' => 1,
				];
			}

			protected static function getDefaultUnit(): string
			{
				return 'a';
			}
		};
	}

	public function call_static_provider()
	{
		return [
			'no values' => ['a', [], 1],
			'no values as non default unit' => ['e', [], 16],
			'zero' => ['b', [0], 0],
			'with value' => ['d', [40], 320],
			'as non default unit' => ['d', [40, 'c'], 80],
			'negative float value' => ['f', [-3.2, 'b'], -51],
		];
	}

	/**
	 * @dataProvider call_static_provider
	 */
	public function test_call_static($name, $arguments, $expected)
	{
		$result = $this->unit::{$name}(...$arguments);

		$this->assertSame($expected, $result);
	}

	public function test_call_static_with_invalid_unit(): void
	{
		$this->expectException(Error::class);

		$this->unit::x(4);
	}

	public function transform_provider()
	{
		return [
			'no values' => [[], 'a', 0],
			'no values as non default unit' => [[], 'e', 0],
			'mixed unit values' => [['f' => 5, 'd' => 3, 'b' => 2], 'a', 188],
			'mixed unit values as non default unit' => [['f' => 5, 'd' => 3, 'b' => 3], 'c', 48],
			'float values' => [['f' => 2.5, 'e' => 3.7], 'a', 139],
			'negative values' => [['f' => -2.1, 'e' => 1], 'b', -26],
			'as bigger unit' => [['c' => 4, 'b' => 1], 'e', 1],
		];
	}

	/**
	 * @dataProvider transform_provider
	 */
	public function test_transform($values, $as, $expected)
	{
		$result = $this->unit->__transform($values, $as);

		$this->assertSame($expected, $result);
	}

	public function test_transform_with_invalid_unit()
	{
		$this->expectException(InvalidArgumentException::class);

		$this->unit->__transform(['e' => 5], 'x');
	}
}
