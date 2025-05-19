<?php

declare(strict_types=1);

namespace App\Services\Notification\Provider;

use App\Services\Notification\NotificationProviderInterface;
use App\Services\Notification\NotificationTemplateInterface;
use Illuminate\Http\Client\Pool;
use Illuminate\Support\Facades\Http;

final class OneSignalNotificationService implements NotificationProviderInterface
{
    public function send(NotificationTemplateInterface $template): void
    {
        Http::pool(function (Pool $pool) use ($template) {
            $pool
                ->asJson()
                ->baseUrl('https://softavis.free.beeceptor.com')
                ->withHeader('Authorization', 'Key abc')
                ->contentType('application/json')
                ->post('/notifications', [
                    'app_id' => 'app123',
                    'template_id' => 'abc123',
                    'custom_data' => $template->getFormattedData(),
                ]);
        });
    }
}
