<?php

namespace BBProjectNet\UnitHelpers;

use InvalidArgumentException;

class Time
{
	public const UNITS = [
		'years',
		'weeks',
		'days',
		'hours',
		'minutes',
		'seconds',
	];

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
	public static function of(int $years = 0, int $weeks = 0, int $days = 0, int $hours = 0, int $minutes = 0, int $seconds = 0, $as = 'seconds'): int
	{
		if (! in_array($as, self::UNITS, true)) {
			throw new InvalidArgumentException('Argument #7 ($as) must be one of the values: ' . implode(', ', self::UNITS));
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
