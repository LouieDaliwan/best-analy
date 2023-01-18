<?php

namespace Customer\Models\Attributes;

use Illuminate\Pagination\LengthAwarePaginator;

trait HavePaginationCompany
{
    /**
     * Modify default Model's pagination
     * to react to url parameters.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function paginate()
    {
        return $this->model()->paginate($this->getPerPage());
    }

    /**
     * Retrieve all resources and paginate.
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function listCompany()
    {
        if ($this->isSearching()) {
            $this->model = $this->whereIn(
                $this->getKeyName(), $this->search(
                    $this->request()->get('search')
                )->keys()->toArray()
            );
        }

        $model = $this->ownedCompany();

        $model = $model->paginate($this->getPerPage());

        $sorted = $this->sortAndOrder($model);

        return new LengthAwarePaginator($sorted, $model->total(), $model->perPage());
    }

    /**
     * Retrieve the items per page value.
     *
     * @return mixed
     */
    protected function getPerPage():? int
    {
        $perPage = $this->request()->get('per_page') == '-1' ? 'all' : $this->request()->get('per_page');

        return strtolower($perPage) === 'all'
             ? count($this->model->get())
             : (int) $perPage ?? settings('display:perpage', 15);
    }
}
