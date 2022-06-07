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
        
        foreach($event->attributes['fields'] as $field) {
            if($field['submission']['fieldKey'] == 'Business Expansion') {
                if($field['submission']['results'] != 'NA') {
                    $score = (int) round($field['submission']['score'] / 5, 2);

                    $variables['be']['score'] += $score;
                    $variables['be']['count']++;
                }            
            }            
            
            if($field['submission']['fieldKey'] == 'Marketing Strategies') {
                if($field['submission']['results'] != 'NA') {
                    $score = (int) round($field['submission']['score'] / 5, 2);

                    $variables['ms']['score'] += $score;
                    $variables['ms']['count']++;
                }             
            }

            if($field['submission']['fieldKey'] == 'Endorsement, Certification & Standards') {
                if($field['submission']['results'] != 'NA') {

                    $score = (int) round($field['submission']['score'] / 5, 2);
                    $variables['es']['score'] += $score;
                    $variables['es']['count']++;
                }            
            }

            if($field['submission']['fieldKey'] == "Location (Describe your level of satisfaction with your current business location's ability to serve customers)") {
                if($field['submission']['results'] != 'NA') {
                    $score = (int) round($field['submission']['score'] / 5, 2);
                    $variables['ll']['score'] += $score;
                    $variables['ll']['count']++;
                }            
            }

            if($field['submission']['fieldKey'] == 'Capacity Utilisation') {
                if($field['submission']['results'] != 'NA') {
                    $score = (int) round($field['submission']['score'] / 5, 2);

                    $variables['cu']['score'] += $score;
                    $variables['cu']['count']++;
                }            
            }

            if($field['submission']['results'] != 'NA') {
                $score = (int) round($field['submission']['score'] / 5, 2);
                $variables['index']['score'] += $score;
                $variables['index']['count']++;
            }            
        }

        $this->getResult($variables);


        SDMIIndexScore::updateOrCreate([
            'customer_id' => (int)$event->attributes['fields'][0]['submission']['customer_id'],
            'month_key' => $date,
        ],[
            'taxonomy_id' => $event->survey->formable_id,
            'metadata' => $this->metadata,
        ]);
    }

    protected function getResult($variables)
    {
        foreach($this->metadata as $key => $value) {
            $score = $variables[$key]['score'];
            $divisor = $variables[$key]['count'];
            $this->metadata[$key] += $divisor != 0 ? number_format(($score / $divisor), 3) : 0;
        }
    }
}
