# Unit helpers

This package is intended to make it easier to specify time and size in configuration files more clearly.

### Example 1:

```php
// Before
$query->where('size', '>=', 209715200)->get();

// After
$query->where('size', '>=', Size::mb(200))->get();
```

### Example 2:

```php
// Before
$config = [
	'expiration' => 4680, // 3 days and 6 hours in minutes
];

// After
$config = [
	'expiration' => Time::of(days: 3, hours: 6, 'minutes'),
	// or
	'expiration' => Time::of(days: 3.25, 'minutes'),
	// or
	'expiration' => Time::days(3.25, 'minutes'),
];
```

### Example 3:

```php
// Before
class Job
{
	protected int $timeout = 10800;
}

// After
class Job
{
	protected int $timeout = Time::HOUR * 3;
}
```

## Requirements

- PHP 8.0 and above

## Installation

Require this package with composer using the following command:

```bash
composer require bbprojectnet/unit-helpers
```

## Usage

As simple static call:

```php
$timeout = Time::hours(4);
```

Static call with output unit specified:

```php
$timeout = Time::hours(4, 'minutes');
```

As method parameter:

```php
$timeout = Time::of(days: 2);
```

With mixed unit types:

```php
$timeout = Time::of(days: 2, hours: 10);
```

With mixed unit types and output unit specified:

```php
$timeout = Time::of(days: 2, hours: 10, as: 'minutes');
```

With mixed unit types, fractions, negative values and output unit specified:

```php
$timeout = Time::of(days: 2.4, hours: -2, minutes: 0.5, as: 'minutes');
```

As constant in places where method invocation is not possible:

```php
protected int $timeout = Time::HOUR * 3;
```

## License

The Unit helpers package is open-sourced software licensed under the MIT license.
