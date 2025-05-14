<?php

declare(strict_types=1);

namespace App\Monolog\Formatter;

use Monolog\Formatter\LineFormatter;
use Monolog\LogRecord;

final class EventLogFormatter extends LineFormatter
{
    public function format(LogRecord $record): string
    {
        $backtrace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);

        $record['extra']['host'] = gethostname() ?? 'php-cli';
        $record['extra']['trace'] = $backtrace['0']['file'] . ':' . $backtrace['0']['line'];

        return parent::format($record);
    }
}
