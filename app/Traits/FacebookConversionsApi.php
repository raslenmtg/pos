<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

trait FacebookConversionsApi
{
    /**
     * Send event to Facebook Conversions API.
     *
     * @param Request $request
     * @param string $eventName
     * @param array $customData
     * @param array $userData
     * @return void
     */
    protected function sendFacebookApiEvent(Request $request, string $eventName, array $customData = [], array $userData = [])
    {
        $pixelId = config('services.facebook.pixel_id');
        $accessToken = config('services.facebook.api_access_token');

        if (empty($pixelId) || empty($accessToken)) {
            return;
        }

        $hashedUserData = [];
        foreach ($userData as $key => $value) {
            if (!empty($value)) {
                $hashedUserData[$key] = hash('sha256', $value);
            }
        }

        $eventData = [
            'event_name' => $eventName,
            'event_time' => time(),
            'action_source' => 'website',
            'event_source_url' => $request->fullUrl(),
            'user_data' => array_merge([
                'client_ip_address' => $request->ip(),
                'client_user_agent' => $request->header('User-Agent'),
                'fbc' => $request->cookie('_fbc'),
                'fbp' => $request->cookie('_fbp'),
            ], $hashedUserData),
        ];

        if (!empty($customData)) {
            $eventData['custom_data'] = $customData;
        }

        $payload = ['data' => [$eventData]];


        //    $payload['test_event_code'] = config('services.facebook.test_event_code');


        $url = "https://graph.facebook.com/v19.0/{$pixelId}/events?access_token={$accessToken}";

        try {
            Http::post($url, $payload);
        } catch (\Exception $e) {
            Log::error('Facebook Conversions API Error: ' . $e->getMessage());
        }
    }
}

