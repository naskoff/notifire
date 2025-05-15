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
        return match ($payload['event_type'] ?? null) {
            self::TEMPLATE_MATCH_START => MatchStartTemplate::fromRequest($payload),
            self::TEMPLATE_MATCH_HALF_TIME => MatchHalfTimeTemplate::fromRequest($payload),
            self::TEMPLATE_MATCH_FINISH => MatchFinishTemplate::fromRequest($payload),
            default => null,
        };
    }
}
