<?php

namespace BBProjectNet\UnitHelpers;

use Error;
use InvalidArgumentException;

abstract class Unit
{
	/**
	 * Static call
	 *
	 * @param string $name
	 * @param array<int, mixed> $arguments
	 * @return int
	 */
	public static function __callStatic(string $name, array $arguments)
	{
		if (! isset(static::getUnits()[$name])) {
			throw new Error('Call to undefined method ' . static::class . '::' . $name . '()');
		}

		return static::transform([$name => $arguments[0] ?? 1], $arguments[1] ?? static::getDefaultUnit());
	}

	/**
	 * Available units with multiplers
	 *
	 * @return array<string, int>
	 */
	abstract protected static function getUnits(): array;

	/**
	 * Default unit name
	 *
	 * @return string
	 */
	abstract protected static function getDefaultUnit(): string;

	/**
	 * Transform values to output unit
	 *
	 * @param array<string, int|float> $values
	 * @param string $as
	 * @return int
	 */
	protected static function transform(array $values, string $as): int
	{
		$units = static::getUnits();

		if (! isset($units[$as])) {
			throw new InvalidArgumentException('Argument #' . (count($values) + 1) . ' ($as) must be one of the values: ' . implode(', ', array_keys($units)));
		}

		$total = 0;

		foreach ($values as $unit => $value) {
			$total += $value * $units[$unit];
		}

		return (int)round($total / $units[$as]);
	}
}
