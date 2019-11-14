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
        if ($this->isSearching()) {
            $this->model = $this->searchTrash($this->request()->get('search'));
        }

        $this->model = $this->sortAndOrder();

        $model = $this->onlyOwned()->with($this->appendToList ?? [])->onlyTrashed();

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
