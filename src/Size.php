<?php

namespace BBProjectNet\UnitHelpers;

use Error;
use InvalidArgumentException;

/**
 * @method static int tb(int $quantity, string $as = 'b')
 * @method static int gb(int $quantity, string $as = 'b')
 * @method static int mb(int $quantity, string $as = 'b')
 * @method static int kb(int $quantity, string $as = 'b')
 * @method static int b(int $quantity, string $as = 'b')
 */
class Size
{
	public const OF = [
		'tb' => 1099511627776,
		'gb' => 1073741824,
		'mb' => 1048576,
		'kb' => 1024,
		'b' => 1,
	];

	/**
	 * Size in given unit
	 *
	 * @param int $tb
	 * @param int $gb
	 * @param int $mb
	 * @param int $kb
	 * @param int $b
	 * @param string $as
	 * @return int
	 */
	public static function of(int $tb = 0, int $gb = 0, int $mb = 0, int $kb = 0, int $b = 0, string $as = 'b'): int
	{
		if (! isset(self::OF[$as])) {
			throw new InvalidArgumentException('Argument #6 ($as) must be one of the values: ' . implode(', ', array_keys(self::OF)));
		}

		$total = 0;

		foreach (self::OF as $unit => $multiple) {
			$total += ${$unit} * $multiple;

			if ($unit === $as) {
				return intdiv($total, $multiple);
			}
		}
	}

	/**
	 * Static call
	 *
	 * @param string $name
	 * @param array<int, int|string> $arguments
	 * @return int
	 */
	public static function __callStatic(string $name, array $arguments)
	{
		if (! isset(self::OF[$name])) {
			throw new Error('Call to undefined method ' . static::class . '::' . $name . '()');
		}

		return static::of(...[
			$name => $arguments[0] ?? 1,
			'as' => $arguments[1] ?? 'b',
		]);
	}
}
