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
use Pensoft\AwtErrorFormatter\ErrorPayloadFormatter;
```

Formatting the error
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
Response format
```php
[
    'service_name'  => $serviceName,
    'service_id'    => $serviceId ?? 'no-service-id',  // or cast to string/number as needed
    'message'       => $throwable->getMessage(),       // string error message
    'user_id'       => $userId,                        // e.g., UUID or null
    'timestamp'     => now()->timestamp,               // integer Unix timestamp
    'service_type'  => $serviceType,                   // e.g., 'backend' or 'frontend'

    // "details" section with request info & error code
    'details' => [
        'error_type'    => $errorType,                      // e.g., 'HTTP' or 'CRONJOB'
        'uri'           => $request->fullUrl(),             // e.g. "https://example.com/path"
        'method'        => $request->method(),              // e.g. "GET", "POST", etc.
        'user_agent'    => $request->header('User-Agent') ?? 'unknown',
        'payload'       => $request->all(),                 // entire request input as an array
        'error_code'    => $throwable->getCode(),           // numeric or 0 if none
        'stack_trace'   => $throwable->getTrace(),          // array full stack trace
        'file_name'     => $throwable->getFile(),           // file path
        'line_number'   => $throwable->getLine(),           // integer line number
    ],
]
```