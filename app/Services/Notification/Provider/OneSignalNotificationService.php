<?php

declare(strict_types=1);

namespace App\Services\Notification\Provider;

use App\Services\Notification\NotificationProviderInterface;
use App\Services\Notification\NotificationTemplateInterface;

final class OneSignalNotificationService implements NotificationProviderInterface
{
    public function send(NotificationTemplateInterface $template): void
    {
    }
}
