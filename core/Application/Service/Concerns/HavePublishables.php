<?php

namespace Core\Application\Service\Concerns;

use Illuminate\Database\Eloquent\Model;

trait HavePublishables
{
    /**
     * Retrieve all published resources and
     * return a paginated list.
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function listPublished()
    {
        $this->model = $this->whereNotNull('published_at');

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

    /**
     * Update the publishing date to the current
     * timestamp and fire an event.
     *
     * @param  \Illuminate\Database\Eloquent\Model $model
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function publish(Model $model): ?Model
    {
        return $model->publish();
    }

    /**
     * Update the publishing date to null and fire an event.
     *
     * @param  \Illuminate\Database\Eloquent\Model $model
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function unpublish(Model $model): ?Model
    {
        return $model->unpublish();
    }

    /**
     * Update the drafted date to the current
     * timestamp and fire an event.
     *
     * @param  \Illuminate\Database\Eloquent\Model $model
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function draft(Model $model): ?Model
    {
        return $model->draft();
    }
}
