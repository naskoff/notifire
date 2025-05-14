<?php

declare(strict_types=1);

namespace App\Services\Notification;

interface NotificationProviderInterface
{
    public function send(NotificationTemplateInterface $template): void;
}
