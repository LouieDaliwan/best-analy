<?php

namespace Best\Services;

use Best\Models\Best;
use Setting\Models\Setting;
use Illuminate\Http\Request;
use Best\Models\KSRRecommendation;
use Core\Application\Service\Service;
use Illuminate\Support\Facades\Cache;
use Spatie\TranslationLoader\LanguageLine;
use Best\Pro\KeyStrategicRecommendationComments;

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
    
        $ksrLists = Cache::rememberForever('ksrData', function () {
            return KSRRecommendation::get(['name', 'metadata'])
            ->keyBy('name')
            ->toArray();
        });
        
        $data = [
            'Edit Financial Management' => collect(
                $ksrLists['fmpi']['metadata']
            )->map(function ($d) {
                return [
                    'en' => collect($d)->values()->shift(),
                    'ar' => __(collect($d)->values()->shift(), [], 'ar')
                ];
            })->toArray(),
            'Edit Human Resource' => collect(
                $ksrLists['hrpi']['metadata']
            )->map(function ($d) {
                return [
                    'en' => collect($d)->values()->shift(),
                    'ar' => __(collect($d)->values()->shift(), [], 'ar')
                ];
            })->toArray(),
            'Edit Business Sustainability' => collect(
                $ksrLists['bspi']['metadata']
            )->map(function ($d) {
                return [
                    'en' => collect($d)->values()->shift(),
                    'ar' => __(collect($d)->values()->shift(), [], 'ar')
                ];
            })->toArray(),
            'Edit Productivity Management' => collect(
                $ksrLists['pmpi']['metadata']
            )->map(function ($d) {
                return [
                    'en' => collect($d)->values()->shift(),
                    'ar' => __(collect($d)->values()->shift(), [], 'ar')
                ];
            })->toArray(),
            // 'Others' => collect(
            //     KeyStrategicRecommendationComments::otherRecommendations()
            // )->map(function ($d) {
            //     return [
            //         'en' => collect($d)->values()->shift(),
            //         'ar' => __(collect($d)->values()->shift(), [], 'ar')
            //     ];
            // })->toArray(),
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

    /**
     * Save the overall comments.
     *
     * @param  array $attributes
     * @return mixed
     */
    public function saveOverallComment($attributes)
    {
        $key = "overall:comment/".$attributes['customer_id'].$attributes['key'];

        return Setting::updateOrCreate([
            'key' => $key,
            'user_id' => $attributes['user_id'] ?? auth()->id(),
        ], [
            'value' => $attributes['value'],
            'user_id' => $attributes['user_id'] ?? auth()->id(),
        ]);
    }
}
