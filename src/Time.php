<?php

namespace BBProjectNet\UnitHelpers;

use Error;
use InvalidArgumentException;

/**
 * @method static int years(int $quantity, string $as = 'seconds')
 * @method static int weeks(int $quantity, string $as = 'seconds')
 * @method static int days(int $quantity, string $as = 'seconds')
 * @method static int hours(int $quantity, string $as = 'seconds')
 * @method static int minutes(int $quantity, string $as = 'seconds')
 * @method static int seconds(int $quantity, string $as = 'seconds')
 */
class Time
{
	public const OF = [
		'years' => 31536000,
		'weeks' => 604800,
		'days' => 86400,
		'hours' => 3600,
		'minutes' => 60,
		'seconds' => 1,
	];

	/**
	 * Time interval in given unit
	 *
	 * @param int $years
	 * @param int $weeks
	 * @param int $days
	 * @param int $hours
	 * @param int $minutes
	 * @param int $seconds
	 * @param string $as
	 * @return int
	 */
	public static function of(int $years = 0, int $weeks = 0, int $days = 0, int $hours = 0, int $minutes = 0, int $seconds = 0, string $as = 'seconds'): int
	{
		if (! isset(self::OF[$as])) {
			throw new InvalidArgumentException('Argument #7 ($as) must be one of the values: ' . implode(', ', array_keys(self::OF)));
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
		if ($name[-1] !== 's') {
			$name .= 's';
		}

		if (! isset(self::OF[$name])) {
			throw new Error('Call to undefined method ' . static::class . '::' . $name . '()');
		}

		return static::of(...[
			$name => $arguments[0] ?? 1,
			'as' => $arguments[1] ?? 'seconds',
		]);
	}
}
