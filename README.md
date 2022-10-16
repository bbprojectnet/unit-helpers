# Unit helpers

This package is intended to make it easier to specify time and size in configuration files more clearly.

### Example 1:

Before:

```php
$query->where('size', '>=', 209715200)->get();
```

After:

```php
$query->where('size', '>=', Size::mb(200))->get();
```

### Example 2:

Before:

```php
$config = [
	'expiration' => 4680, // 3 days and 6 hours in minutes
];
```

After:

```php
$config = [
	'expiration' => Time::of(days: 3, hours: 6, 'minutes'),
];
```

### Example 3:

Before:

```php
class Job
{
	protected int $timeout = 10800;
}
```

After:

```php
class Job
{
	protected int $timeout = Time::OF['hours'] * 3;
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
$timeout = Time::of(days: 2, hours: 12);
```

With mixed unit types and output unit specified:

```php
$timeout = Time::of(days: 2, hours: 12, as: 'minutes');
```

As constant in places where method invocation is not possible:

```php
protected int $timeout = Time::OF['hours'] * 3;
```

## License

The Unit helpers package is open-sourced software licensed under the MIT license.
