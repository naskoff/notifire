<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Events\SendNotification;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class NotificationController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        event(new SendNotification($request->all()));

        Log::debug('Receive event notification requests');

        return response()->json(['status' => true]);
    }
}
