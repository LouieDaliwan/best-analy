<?php

namespace Subscription\Services;

trait HaveSubscribables
{
    /**
     * Retrieve all subscribed resources and
     * return a paginated list.
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function listSubscribed()
    {
        $this->model = $this->subscribedBy($this->auth()->user());

        if ($this->isSearching()) {
            $this->model = $this->whereIn(
                $this->getKeyName(), $this->search(
                    $this->request()->get('search')
                )->keys()->toArray()
            );
        }

        $model = $this->sortAndOrder();

        return $model->paginate($this->getPerPage());
    }
}
