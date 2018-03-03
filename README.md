[![Build Status](https://travis-ci.org/hedii/ip-checker.svg?branch=master)](https://travis-ci.org/hedii/ip-checker)

# ip-checker

Check whether an ip address can be used in a Laravel application. Receive an email notification when an ip address does not pass the check.

## Table of contents

- [Table of contents](#table-of-contents)
- [Installation](#installation)
- [Usage](#usage)
- [Testing](#testing)
- [License](#license)

## Installation

Install via [composer](https://getcomposer.org/doc/00-intro.md)
```
composer require hedii/ip-checker
```

Publish and edit the configuration (`config/ip-checker.php`)
```
php artisan vendor:publish --provider="Hedii\IpChecker\IpCheckerServiceProvider" --tag="config"
```

## Usage

#### Manual check

Run the package command manually

```
php artisan ip:check
```

#### Scheduled check

Schedule the package command to check the ip addresses at regular interval.

To check the ip addresses every hour, edit `app/Console/Kernel.php`

```php
/**
 * Define the application's command schedule.
 *
 * @param \Illuminate\Console\Scheduling\Schedule $schedule
 */
 protected function schedule(Schedule $schedule)
 {
     $schedule->command('ip:check')->hourly();
 }
```

## Testing

```
composer test
```

## License

hedii/ip-checker is released under the MIT Licence. See the bundled [LICENSE](https://github.com/hedii/ip-checker/blob/master/LICENSE.md) file for details.
