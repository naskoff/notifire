<?php

declare(strict_types=1);

namespace App\Services\Notification;

use App\Services\Notification\Template\MatchFinishTemplate;
use App\Services\Notification\Template\MatchHalfTimeTemplate;
use App\Services\Notification\Template\MatchStartTemplate;

final class NotificationTemplateFactory
{
    const TEMPLATE_MATCH_START = 'match_start';

    const TEMPLATE_MATCH_HALF_TIME = 'match_half_time';

    const TEMPLATE_MATCH_FINISH = 'match_finish';

    public static function createTemplateFromRequest(array $payload): ?NotificationTemplateInterface
    {
        $template = match ($payload['event_type'] ?? null) {
            self::TEMPLATE_MATCH_START => MatchStartTemplate::class,
            self::TEMPLATE_MATCH_HALF_TIME => MatchHalfTimeTemplate::class,
            self::TEMPLATE_MATCH_FINISH => MatchFinishTemplate::class,
            default => null,
        };

        if ($template) {
            return (new $template($payload))->fromRequest($payload);
        }

        return null;
    }
}
