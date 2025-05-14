<?php

declare(strict_types=1);

namespace App\Services;

interface NotificationTemplateInterface
{
    public static function fromRequest(array $payload): ?self;
}
