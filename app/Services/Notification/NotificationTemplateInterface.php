<?php

declare(strict_types=1);

namespace App\Services\Notification;

interface NotificationTemplateInterface
{
    public static function fromRequest(array $payload): ?self;

    public static function getRules(): array;

    public function getFormattedData(): array;
}
