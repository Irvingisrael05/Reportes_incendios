<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class WeatherService
{
    public function getWeatherByCoordinates($latitude, $longitude)
    {
        $response = Http::get('https://api.open-meteo.com/v1/forecast', [
            'latitude' => $latitude,
            'longitude' => $longitude,
            'current' => 'temperature_2m,relative_humidity_2m,precipitation,wind_speed_10m,wind_direction_10m,pressure_msl,cloud_cover',
            'timezone' => 'auto'
        ]);

        if (!$response->successful()) {
            return null;
        }

        $current = $response->json('current');

        $windDegrees = $current['wind_direction_10m'] ?? null;

        return [
            'temperature' => $current['temperature_2m'] ?? null,
            'humidity' => $current['relative_humidity_2m'] ?? null,
            'precipitation' => $current['precipitation'] ?? 0,
            'wind_speed' => $current['wind_speed_10m'] ?? null,
            'wind_direction' => $this->convertWindDirection($windDegrees),
            'atmospheric_pressure' => $current['pressure_msl'] ?? null,
            'cloudiness' => $current['cloud_cover'] ?? null,
        ];
    }

    private function convertWindDirection($degrees)
    {
        if ($degrees === null) {
            return null;
        }

        $directions = [
            'Norte',
            'Noreste',
            'Este',
            'Sureste',
            'Sur',
            'Suroeste',
            'Oeste',
            'Noroeste'
        ];

        $index = round($degrees / 45) % 8;

        return $directions[$index];
    }
}
