<?php

declare(strict_types=1);

namespace App\Services\Notification\Template;

use App\Services\Notification\NotificationTemplateInterface;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

abstract readonly class AbstractMatchTemplate implements NotificationTemplateInterface
{
    public function __construct(protected array $data)
    {
    }

    public static function fromRequest(array $payload): ?self
    {
        $validated = Validator::make($payload, static::getRules());

        if ($validated->fails()) {
            Log::critical('Data missing from payload', ['errors' => $validated->messages()->toArray()]);

            return null;
        }

        return new static(data: $validated->validated());
    }

    public static function getRules(): array
    {
        return [
            'home_team' => ['required', 'string'],
            'away_team' => ['required', 'string'],
        ];
    }

    public function getFormattedData(): array
    {
        return $this->data;
    }
}
