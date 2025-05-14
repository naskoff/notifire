<?php

declare(strict_types=1);

namespace App\Services\Provider;

use App\Services\NotificationProviderInterface;
use App\Services\NotificationTemplateInterface;

final class OneSignalNotificationService implements NotificationProviderInterface
{
    public function send(NotificationTemplateInterface $template): void
    {
    }
}
