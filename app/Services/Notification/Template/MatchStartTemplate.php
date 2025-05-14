<?php

declare(strict_types=1);

namespace App\Services\Notification\Template;

final readonly class MatchStartTemplate extends AbstractMatchTemplate
{
    public static function getRules(): array
    {
        $rules = parent::getRules();

        $rules['home_score'] = ['required', 'integer', 'min:0'];
        $rules['away_score'] = ['required', 'integer', 'min:0'];

        return $rules;
    }
}
