<?php

use Best\Models\KSRRecommendation;
use Illuminate\Database\Seeder;

class KSRRecommendationSeeder extends Seeder
{
    protected $keys = ['fmpi', 'bspi', 'pmpi', 'hrpi'];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = $this->getListRecommendations();

        foreach ($this->keys as $key) {
            KSRRecommendation::firstOrCreate([
                'name' =>  $key,
                'metadata' => $data[$key],
            ]);
        }
    }

    protected function getListRecommendations()
    {
        $lists = [];

        $ksr = config('ksrecommendation');

        foreach ($this->keys as $key) {

            isset($lists[$key]) ? : $lists[$key] = [];

            $dataValue = $ksr[$key]['list'];

            foreach ($dataValue as $idKey => $list) {

                isset($dataValue[$idKey]['priority']) ? : $dataValue[$idKey]['priority'] = false;

                $lists[$key][$idKey] = $dataValue[$idKey];

            }
        }

        return $lists;
    }
}
