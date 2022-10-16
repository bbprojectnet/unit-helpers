<?php

namespace BBProjectNet\UnitHelpers;

/**
 * Size
 *
 * @method static int pb(int|float $quantity = 1, string $as = 'b')
 * @method static int tb(int|float $quantity = 1, string $as = 'b')
 * @method static int gb(int|float $quantity = 1, string $as = 'b')
 * @method static int mb(int|float$quantity = 1, string $as = 'b')
 * @method static int kb(int|float $quantity = 1, string $as = 'b')
 * @method static int b(int|float $quantity = 1, string $as = 'b')
 */
class Size extends Unit
{
	public const PB = 1125899906842624;
	public const TB = 1099511627776;
	public const GB = 1073741824;
	public const MB = 1048576;
	public const KB = 1024;
	public const B = 1;

	/**
	 * Size in given unit
	 *
	 * @param int|float $pb
	 * @param int|float $tb
	 * @param int|float $gb
	 * @param int|float $mb
	 * @param int|float $kb
	 * @param int|float $b
	 * @param string $as
	 * @return int
	 */
	public static function of(
		int|float $pb = 0,
		int|float $tb = 0,
		int|float $gb = 0,
		int|float $mb = 0,
		int|float $kb = 0,
		int|float $b = 0,
		string $as = 'b',
	): int
	{
		return static::transform(compact('pb', 'tb', 'gb', 'mb', 'kb', 'b'), $as);
	}

	/**
	 * @inheritDoc
	 */
	protected static function getUnits(): array
	{
		return [
			'pb' => self::PB,
			'tb' => self::TB,
			'gb' => self::GB,
			'mb' => self::MB,
			'kb' => self::KB,
			'b' => self::B,
		];
	}

	/**
	 * @inheritDoc
	 * @codeCoverageIgnore
	 */
	protected static function getDefaultUnit(): string
	{
		return 'b';
	}
}
