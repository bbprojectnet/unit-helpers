<?php

namespace BBProjectNet\UnitHelpers;

use InvalidArgumentException;

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
	public static function of(int $tb = 0, int $gb = 0, int $mb = 0, int $kb = 0, int $b = 0, $as = 'b'): int
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
}
