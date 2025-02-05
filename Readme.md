# ErrorPayloadFormatter

[![Build Status](https://img.shields.io/travis/pensoft/awt-error-formatter/master.svg)](https://travis-ci.org/pensoft/awt-error-formatter)
[![Latest Version](https://img.shields.io/packagist/v/pensoft/awt-error-formatter.svg)](https://packagist.org/packages/pensoft/awt-error-formatter)
[![License](https://img.shields.io/packagist/l/pensoft/awt-error-formatter.svg)](LICENSE)

A PHP class for formatting error payloads in applications. This package provides a simple and consistent way to convert error information into a structured array format, making it easier to log, display, or broadcast errors throughout your application.

## Table of Contents

- [Features](#features)
- [Requirements](#requirements)
- [Installation](#installation)
- [Usage](#usage)
- [Testing](#testing)
- [Contributing](#contributing)
- [License](#license)

## Features

- **Consistent Error Formatting:** Provides a custom format for error payloads.
- **Laravel Integration:** Utilizes `Illuminate\Http\Request` for request data and accepts any `Throwable` instance for flexible error handling.
- **PSR-4 Autoloading:** Easily integrates into your projects via Composer.
- **Robust Error Handling:** Supports the latest PHP error handling best practices by using the `Throwable` interface.

## Requirements

- PHP 8.0 or later
- Laravel (if integrating into a Laravel project)

## Installation

You can install the package via Composer. Add the following line to your project's `composer.json` file:

```bash
composer require pensoft/awt-error-formatter
```

## Usage

Include in your PHP class/file

```php
use Pensoft\ErrorPayloadFormatter\ErrorPayloadFormatter;
```

Formatting error
```php
// Format the error payload
$errorPayload = ErrorPayloadFormatter::format(
    Request $request,
    Throwable $e,
    'serviceName',
    'serviceId'
);
//send $errorPayload to third-party library or service
```
