<?php

namespace App\Services;

use App\Models\ProjectType;
use App\Models\Feature;
use App\Models\Project;

class QuoteService
{
    public function calculate(ProjectType $type, array $featureIds, array $secondaryPlatforms = [])
    {
        $basePrice = $type->base_price;
        $baseDuration = $type->base_duration_days;

        $features = Feature::whereIn('id', $featureIds)->get();
        $featuresPrice = $features->sum('price');
        $featuresDuration = $features->sum('impact_days');

        $totalPrice = $basePrice + $featuresPrice;
        $totalDuration = $baseDuration + $featuresDuration;

        $additionalPlatforms = [];
        foreach ($secondaryPlatforms as $platform) {
            $platformData = $this->getPlatformMultiplier($platform, $basePrice, $baseDuration);
            $totalPrice += $platformData['price'];
            $totalDuration += $platformData['duration'];
            $additionalPlatforms[] = array_merge(['type' => $platform], $platformData);
        }

        return [
            'base_price' => $basePrice,
            'base_duration' => $baseDuration,
            'features_price' => $featuresPrice,
            'features_duration' => $featuresDuration,
            'additional_platforms' => $additionalPlatforms,
            'total_price' => $totalPrice,
            'total_duration' => $totalDuration,
            'deposit' => $totalPrice * 0.4,
            'balance' => $totalPrice * 0.6,
        ];
    }

    private function getPlatformMultiplier($platform, $basePrice, $baseDuration)
    {
        switch ($platform) {
            case 'mobile':
                return [
                    'price' => $basePrice * 0.4,
                    'duration' => 7,
                ];
            case 'web':
                return [
                    'price' => $basePrice * 0.35,
                    'duration' => 5,
                ];
            case 'webapp':
                return [
                    'price' => $basePrice * 0.45,
                    'duration' => 10,
                ];
            default:
                return ['price' => 0, 'duration' => 0];
        }
    }
}
