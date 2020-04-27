<?php

namespace Best\Services;

use Best\Models\Best;
use Best\Pro\KeyStrategicRecommendationComments;
use Core\Application\Service\Service;
use Illuminate\Http\Request;
use Spatie\TranslationLoader\LanguageLine;

class SettingService extends Service implements SettingServiceInterface
{
    /**
     * The property on class instances.
     *
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model;

    /**
     * The Request instance.
     *
     * @var \Illuminate\Http\Request
     */
    protected $request;

    /**
     * Constructor to bind model to a repository.
     *
     * @param \Spatie\TranslationLoader\LanguageLine $model
     * @param \Illuminate\Http\Request               $request
     */
    public function __construct(LanguageLine $model, Request $request)
    {
        $this->model = $model;
        $this->request = $request;
    }

    /**
     * Retrieve all translation files.
     *
     * @return array
     */
    public function getAllTranslationKeys()
    {
        $data = [
            'Edit Financial Management' => collect(
                KeyStrategicRecommendationComments::fmpiRecommendations()
            )->map(function ($d) {
                return [
                    'en' => collect($d)->values()->shift(),
                    'ar' => __(collect($d)->values()->shift(), [], 'ar')
                ];
            })->toArray(),
            'Edit Human Resource' => collect(
                KeyStrategicRecommendationComments::hrpiRecommendations()
            )->map(function ($d) {
                return [
                    'en' => collect($d)->values()->shift(),
                    'ar' => __(collect($d)->values()->shift(), [], 'ar')
                ];
            })->toArray(),
            'Edit Business Sustainability' => collect(
                KeyStrategicRecommendationComments::bspiRecommendations()
            )->map(function ($d) {
                return [
                    'en' => collect($d)->values()->shift(),
                    'ar' => __(collect($d)->values()->shift(), [], 'ar')
                ];
            })->toArray(),
            'Edit Productivity Management' => collect(
                KeyStrategicRecommendationComments::pmpiRecommendations()
            )->map(function ($d) {
                return [
                    'en' => collect($d)->values()->shift(),
                    'ar' => __(collect($d)->values()->shift(), [], 'ar')
                ];
            })->toArray(),
            'Others' => collect(
                KeyStrategicRecommendationComments::otherRecommendations()
            )->map(function ($d) {
                return [
                    'en' => collect($d)->values()->shift(),
                    'ar' => __(collect($d)->values()->shift(), [], 'ar')
                ];
            })->toArray(),
        ];

        return $data;
    }

    /**
     * Save all translation files.
     *
     * @param  array $attributes
     * @return void
     */
    public function saveTranslationKeys($attributes)
    {
        foreach ($attributes['translations'] as $key => $locales) {
            LanguageLine::updateOrCreate([
                'group' => '*',
                'key' => $key ?? null,
            ], [
                'group' => '*',
                'text' => [
                    'en' => $key ?? null,
                    'ar' => $locales['ar'] ?? $key ?? null,
                ],
            ]);
        }
    }
}
