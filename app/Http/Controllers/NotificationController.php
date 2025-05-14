<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\NotificationService;
use App\Services\NotificationTemplateInterface;
use App\Services\Provider\OneSignalNotificationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class NotificationController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        $template = NotificationService::createTemplateFromRequest($request->all());
        if ($template instanceof NotificationTemplateInterface) {
            app(OneSignalNotificationService::class)->send($template);
            dd($template);
        }

        Log::debug('Receive event notification requests');

        return response()->json(['status' => true]);
    }
}
