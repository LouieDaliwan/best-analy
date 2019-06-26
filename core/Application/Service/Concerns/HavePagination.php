<?php

namespace Core\Application\Service\Concerns;

trait HavePagination
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
    public function list()
    {
        if ($this->isSearching()) {
            $this->model = $this->search($this->request()->get('search'));
            $model = $this->sortAndOrder();
        } else {
            $model = $this->sortAndOrder();
            $model = $model->with($this->appendToList ?? []);
        }

        return $model->paginate($this->getPerPage());
    }

    /**
     * Retrieve the items per page value.
     *
     * @return mixed
     */
    protected function getPerPage():? int
    {
        return strtolower($this->request()->get('per_page')) === 'all'
             ? count($this->model->get())
             : $this->request()->get('per_page') ?? settings('display:perpage');
    }
}
