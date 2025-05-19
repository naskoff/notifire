<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Events\SendNotification;
use App\Services\Notification\NotificationTemplateFactory;
use App\Services\Notification\NotificationTemplateInterface;
use App\Services\Notification\Provider\OneSignalNotificationService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;

class SendNotificationListener implements ShouldQueue
{
    use Queueable;

    public function handle(SendNotification $event): void
    {
        $template = NotificationTemplateFactory::createTemplateFromRequest($event->data);
        if ($template instanceof NotificationTemplateInterface) {
            app(OneSignalNotificationService::class)->send($template);

            Log::info('Send notification template success', ['template' => $template]);

            return;
        }

        Log::critical('Send notification template fail', ['template' => $template]);
    }
}
