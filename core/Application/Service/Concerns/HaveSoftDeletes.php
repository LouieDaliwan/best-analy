<?php

namespace Core\Application\Service\Concerns;

trait HaveSoftDeletes
{
    /**
     * Include only soft deleted records in the results.
     *
     * @return $this
     */
    public function listTrashed()
    {
        $model = $this->sortAndOrder();

        if ($this->isSearching()) {
            $this->model = $this->searchTrash();
        } else {
            $this->model = $this->with($this->appendToList ?? [])->onlyTrashed();
        }

        $model = $this->onlyOwned();

        return $model->paginate($this->getPerPage());
    }

    /**
     * Search through the search index,
     * then filter to retrieve only trashed resources.
     *
     * @param  string $keyword
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function searchTrash($keyword = null)
    {
        $ids = with($this->search($keyword)->raw(), function ($raw) {
            return $raw['ids'] ?? [];
        });

        return $this->model->whereIn($this->getScoutKeyName(), $ids)->onlyTrashed();
    }
}
