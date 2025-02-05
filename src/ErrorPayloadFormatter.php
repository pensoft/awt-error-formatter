<?php

namespace Pensoft\ErrorPayloadFormatter;

use Illuminate\Http\Request;
use Throwable;

class ErrorPayloadFormatter
{
    /**
     * Format the given request and throwable into a structured array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable               $throwable
     * @param  string|null              $serviceName
     * @param  string|int|null          $serviceId
     * @return array
     */
    public static function format(
        Request $request,
        Throwable $throwable,
        string|null $serviceName = null,
        string|int|null $serviceId = null
    ): array {
        // Retrieve user ID if available (otherwise use a placeholder or null).
        // Adjust this logic to match your authentication setup.
        $userId = $request->user()?->id ?? 'unknown-user';

        // Example: Hardcode or determine "HTTP" vs "CRONJOB" based on context
        $errorType = 'HTTP';  // or 'CRONJOB'
        $serviceType = 'backend'; // or 'frontend', if you have a different logic

        return [
            'service_name'  => $serviceName,
            'service_id'    => $serviceId ?? 'no-service-id',  // or cast to string/number as needed
            'message'       => $throwable->getMessage(),       // string error message
            'user_id'       => $userId,                        // e.g., UUID or integer
            'timestamp'     => now()->timestamp,               // integer Unix timestamp
            'stack_trace'   => $throwable->getTraceAsString(), // full stack trace
            'file_name'     => $throwable->getFile(),          // file path
            'line_number'   => $throwable->getLine(),          // integer line number
            'error_type'    => $errorType,                     // e.g., 'HTTP' or 'CRONJOB'
            'service_type'  => $serviceType,                   // e.g., 'backend' or 'frontend'

            // "details" section with request info & error code
            'details' => [
                'uri'        => $request->fullUrl(),       // e.g. "https://example.com/path"
                'method'     => $request->method(),        // e.g. "GET", "POST", etc.
                'user_agent' => $request->header('User-Agent') ?? 'unknown',
                'payload'    => $request->all(),           // entire request input as an array
                'error_code' => $throwable->getCode(),     // numeric or 0 if none
            ],
        ];
    }
}
