<?php

declare(strict_types=1);

namespace App\Services\Template;

use App\Services\NotificationTemplateInterface;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

abstract readonly class AbstractMatchTemplate implements NotificationTemplateInterface
{
    public function __construct(protected array $data)
    {
    }

    public static function fromRequest(array $payload): ?self
    {
        $validated = Validator::make($payload, [
            'home_team' => ['required', 'string'],
            'away_team' => ['required', 'string'],
            'home_score' => ['required', 'int'],
        ]);

        if ($validated->fails()) {
            Log::critical('Data missing from payload', ['errors' => $validated->errors()]);

            return null;
        }

        return new static(data: $validated->validated());
    }

    public function getRules(): array
    {
        return [
            'home_team' => ['required', 'string'],
            'away_team' => ['required', 'string'],
        ];
    }

    public function getData(): array
    {
        return $this->data;
    }
}
