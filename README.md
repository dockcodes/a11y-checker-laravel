# PHP Accessibility Checker

Laravel package for communicating with the accessibility audit API.

### Supported functions:

- Running a page audit (scan) – synchronously and asynchronously
- Retrieving the audit result by audit UUID (get)
- Retrieving audit history by address UUID (history)

### Setup
```shell
composer require dockcodes/a11y-checker-laravel
```
### Publish config:
```shell
php artisan vendor:publish --provider="Dock\A11yCheckerLaravel\DockServiceProvider" --tag="config"
````
### Usage
Add to .env file:
```dotenv
A11Y_API_KEY=[CONTACT US FOR API KEY]
```
Code example:
```php
<?php

// Run scan
$result = \A11yChecker::scan('https://example.com');
echo "Audit uuid: " . $result['response']['uuid'] . "\n";
echo "Address uuid: " . $result['response']['address_uuid'] . "\n";

// Get audit result
$report = \A11yChecker::audit($result['uuid']);
print_r($report['response']);

// Get history
$history = \A11yChecker::history($result['address_uuid']);
print_r($history['response']);
```

### Method parameters
```php
scan(string $url, Language $lang = Language::EN, Device $device = Device::DESKTOP, bool $sync = false, bool $extraData = false, ?string $uniqueKey = null)

rescan(string $uuid, Language $lang = Language::EN, bool $sync = false, bool $extraData = false)

audits(string $search, int $page = 1, int $perPage = 10, Sort $sort = Sort::LAST_AUDIT_DESC, ?string $uniqueKey = null)

audit(string $uuid, Language $lang = Language::EN, bool $extraData = false)

user()

deleteAudit(string $uuid)

history(string $uuid, int $page = 1, int $perPage = 10, Sort $sort = Sort::CREATED_AT_ASC)

deleteHistory(string $uuid)

updateAuditManual(string $uuid, string $criterionId, AuditStatus $status, Device $device));
```
To obtain an API key, please contact us via the [contact form](https://wcag.dock.codes/contact-us/).
