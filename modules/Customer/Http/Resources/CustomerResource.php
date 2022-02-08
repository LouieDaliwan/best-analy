<?php

namespace Customer\Http\Resources;

use Best\Models\Report;
use Best\Services\FormulaServiceInterface;
use Customer\Http\Resources\ReportResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Index\Http\Resources\IndexResource;
use Index\Models\Index;

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
                'applicant' => $this->applicant,
                'details' => $this->detail,
                'indices' => Index::all()->map(function ($index) use ($request) {
                    $attributes = [
                        'customer_id' => $this->getKey(),
                        'taxonomy_id' => $index->getKey(),
                        'month' => $request->get('month') ?? date('m-Y'),
                    ];
                    return array_merge(with(new IndexResource($index))->toArray($request), [
                        'report' => new ReportResource($report = Report::where('month', $attributes['month'])
                            ->whereCustomerId($this->getKey())
                            ->whereFormId($index->survey->getKey())
                            ->whereUserId(user()->getKey())->latest()->first()),
                        'is:finished' => ! is_null($report),
                    ]);
                })->toArray(),
            ]));

            if ($only = $request->get('only')) {
                $data = $data->only($only);
            }

            return $data->toArray();
        }
    }
