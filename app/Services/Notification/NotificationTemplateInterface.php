<?php

declare(strict_types=1);

namespace App\Services\Notification;

interface NotificationTemplateInterface
{
    public function fromRequest(array $payload): ?self;

    public function getRules(): array;

    public function getFormattedData(): array;
}
