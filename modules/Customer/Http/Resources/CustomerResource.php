<?php

namespace Customer\Http\Resources;

use Best\Models\Report;
use Best\Services\FormulaServiceInterface;
use Carbon\Carbon;
use Customer\Http\Resources\ReportResource;
use Customer\Models\Attributes\RatingGraph;
use Illuminate\Http\Resources\Json\JsonResource;
use Index\Http\Resources\IndexResource;
use Index\Models\Index;
use Survey\SDMIIndexScore;

    class CustomerResource extends JsonResource
    {
        /**
         * Transform the resource into an array.
         *
         * @param  \Illuminate\Http\Request $request
         * @return array
         */
        public function toArray($request)
        {
            $customer = parent::toArray($request);

            $data = collect(array_merge($customer, [
                'name' => $this->name,
                'refnum' => strtoupper($this->refnum),
                'token' => strtoupper($this->token),
                'filenumber' => $this->filenumber,
                'code' => $this->code,
                'status' => $this->status,
                'user_id' => $this->user_id,
                'author' => $this->author,
                'counselor' => $this->counselor,
                'created' => $this->created,
                'deleted' => $this->deleted,
                'modified' => $this->modified,
                'statements' => $this->statements,
                'latestStatement' => $this->statements()->latest('period')->first(),
                'applicant' => $this->applicant,
                'details' => $this->detail,
                'current_month' => Carbon::now()->format('m-Y'),
                'indices' => Index::all()->map(function ($index) use ($request, $customer) {
                    $attributes = [
                        'customer_id' => $this->getKey(),
                        'taxonomy_id' => $index->getKey(),
                        'month' => $request->get('month') ?? date('m-Y'),
                    ];

                    if($index->alias == 'BGMI') {
                        $answeredSurvey = SDMIIndexScore::where('customer_id', $customer['id'])->where('month_key', $attributes['month'])->first();
                        $reportResult = [
                            'report' => $answeredSurvey != null ? collect([
                                'modified' => $answeredSurvey->updated_at->diffForHumans(),
                                'month' => $answeredSurvey->month_key,
                            ]): null,
                            'is:finished' => $answeredSurvey != null ? : false,
                        ];
                    } else {
                        $reportResult = [
                            'report' => new ReportResource($report = Report::whereCustomerId($this->getKey())
                                ->whereFormId($index->survey->getKey())
                                ->whereUserId(user()->getKey())->latest()->first()),
                            'is:finished' => ! is_null($report),
                        ];
                    }


                    return array_merge(with(new IndexResource($index))->toArray($request), $reportResult);
                })->toArray(),
                'ratings' => RatingGraph::getRatings($this),
            ]));

            if ($only = $request->get('only')) {
                $data = $data->only($only);
            }

            return $data->toArray();
        }
    }
