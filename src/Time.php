<?php

namespace BBProjectNet\UnitHelpers;

/**
 * Time
 *
 * @method static int years(int|float $quantity = 1, string $as = 'seconds')
 * @method static int year(int|float $quantity = 1, string $as = 'seconds')
 * @method static int months(int|float $quantity = 1, string $as = 'seconds')
 * @method static int month(int|float $quantity = 1, string $as = 'seconds')
 * @method static int weeks(int|float $quantity = 1, string $as = 'seconds')
 * @method static int week(int|float $quantity = 1, string $as = 'seconds')
 * @method static int days(int|float $quantity = 1, string $as = 'seconds')
 * @method static int day(int|float $quantity = 1, string $as = 'seconds')
 * @method static int hours(int|float $quantity = 1, string $as = 'seconds')
 * @method static int hour(int|float $quantity = 1, string $as = 'seconds')
 * @method static int minutes(int|float $quantity = 1, string $as = 'seconds')
 * @method static int minute(int|float $quantity = 1, string $as = 'seconds')
 * @method static int seconds(int|float $quantity = 1, string $as = 'seconds')
 * @method static int second(int|float $quantity = 1, string $as = 'seconds')
 */
class Time extends Unit
{
	public const YEAR = 31536000; // 365 days
	public const MONTH = 2592000; // 30 days
	public const WEEK = 604800;
	public const DAY = 86400;
	public const HOUR = 3600;
	public const MINUTE = 60;
	public const SECOND = 1;

	/**
	 * Time interval in given unit
	 *
	 * @param int|float $years
	 * @param int|float $months
	 * @param int|float $weeks
	 * @param int|float $days
	 * @param int|float $hours
	 * @param int|float $minutes
	 * @param int|float $seconds
	 * @param string $as
	 * @return int
	 */
	public static function of(
		int|float $years = 0,
		int|float $months = 0,
		int|float $weeks = 0,
		int|float $days = 0,
		int|float $hours = 0,
		int|float $minutes = 0,
		int|float $seconds = 0,
		string $as = 'seconds',
	): int
	{
		return static::transform(compact('years', 'months', 'weeks', 'days', 'hours', 'minutes', 'seconds'), $as);
	}

	/**
	 * @inheritDoc
	 */
	protected static function getUnits(): array
	{
		return [
			'years' => self::YEAR,
			'year' => self::YEAR,
			'months' => self::MONTH,
			'month' => self::MONTH,
			'weeks' => self::WEEK,
			'week' => self::WEEK,
			'days' => self::DAY,
			'day' => self::DAY,
			'hours' => self::HOUR,
			'hour' => self::HOUR,
			'minutes' => self::MINUTE,
			'minute' => self::MINUTE,
			'seconds' => self::SECOND,
			'second' => self::SECOND,
		];
	}

	/**
	 * @inheritDoc
	 * @codeCoverageIgnore
	 */
	protected static function getDefaultUnit(): string
	{
		return 'seconds';
	}
}
