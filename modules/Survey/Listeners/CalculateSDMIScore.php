<?php

namespace Survey\Listeners;

use Carbon\Carbon;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Survey\SDMIIndexScore;

use function PHPSTORM_META\map;

class CalculateSDMIScore
{
    protected $metadata = [
        'index' => 0,
        'be' => 0,
        'ms' => 0,
        'cu' => 0,
        'es' => 0,
        'll' => 0,
        'count' => 0,
    ];

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $variables = [
            'be' => [
                'score' => 0,
                'count' => 0,
            ],
            'ms' => [
                'score' => 0,
                'count' => 0,
            ],
            'es' => [
                'score' => 0,
                'count' => 0,
            ],
            'cu' => [
                'score' => 0,
                'count' => 0,
            ],
            'll' => [
                'score' => 0,
                'count' => 0,
            ],
            'index' => [
                'score' => 0,
                'count' => 0,
            ],
        ];
        $date = Carbon::parse($event->attributes['remarks'])->format('m-Y');
        $count = 0;
        foreach($event->attributes['fields'] as $field) {
            if($field['submission']['fieldKey'] == 'Business Expansion') {
                if($field['submission']['results'] != 'NA') {
                    $score = (float) round($field['submission']['score'] / 5, 2);

                    $variables['be']['score'] += $score;
                    $variables['be']['count']++;
                }            
            }            
            
            if($field['submission']['fieldKey'] == 'Marketing Strategies') {
                if($field['submission']['results'] != 'NA') {
                    $score = (float) round($field['submission']['score'] / 5, 2);

                    $variables['ms']['score'] += $score;
                    $variables['ms']['count']++;
                }             
            }

            if($field['submission']['fieldKey'] == 'Endorsement, Certification & Standards') {
                if($field['submission']['results'] != 'NA') {

                    $score = (float) round($field['submission']['score'] / 5, 2);
                    $variables['es']['score'] += $score;
                    $variables['es']['count']++;
                }            
            }

            if($field['submission']['fieldKey'] == "Location") {
                if($field['submission']['results'] != 'NA') {
                    $score = (float) round($field['submission']['score'] / 5, 2);
                    $variables['ll']['score'] += $score;
                    $variables['ll']['count']++;
                }            
            }

            if($field['submission']['fieldKey'] == 'Capacity Utilisation') {
                if($field['submission']['results'] != 'NA') {
                    $score = (float) round($field['submission']['score'] / 5, 2);
                    $variables['cu']['score'] += $score;
                    $variables['cu']['count']++;
                }            
            }

            if($field['submission']['results'] != 'NA') {
                $score = (float) round($field['submission']['score'] / 5, 2);
                $variables['index']['score'] += $score;
                $variables['index']['count']++;
                $count++;
            }            
        }

       $metadata = $this->getResult($variables, $count);


        SDMIIndexScore::updateOrCreate([
            'customer_id' => (int)$event->attributes['fields'][0]['submission']['customer_id'],
            'month_key' => $date,
        ],[
            'taxonomy_id' => $event->survey->formable_id,
            'metadata' => $metadata,
        ]);
    }

    protected function getResult($variables, $count)
    {
        $metadata = $this->metadata;

        foreach($metadata as $key => $value) {

            if($key == 'count') {
                continue;
            }

            $score = $variables[$key]['score'];
            $divisor = $variables[$key]['count'];
            $metadata[$key] += $divisor != 0 ? number_format(($score / $divisor), 3) : 0;
            $count += $divisor;
        }

        $metadata['count'] = $count;
        return $metadata;
    }
}
