<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\Notification\NotificationTemplateFactory;
use App\Services\Notification\NotificationTemplateInterface;
use App\Services\Notification\Provider\OneSignalNotificationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class NotificationController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        $template = NotificationTemplateFactory::createTemplateFromRequest($request->all());
        if ($template instanceof NotificationTemplateInterface) {
            app(OneSignalNotificationService::class)->send($template);
        }

        Log::debug('Receive event notification requests');

        return response()->json(['status' => true]);
    }
}
