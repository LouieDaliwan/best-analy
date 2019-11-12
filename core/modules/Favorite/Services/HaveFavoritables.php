<?php

namespace Favorite\Services;

trait HaveFavoritables
{
    /**
     * Retrieve all resources and paginate.
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function listFavorites()
    {
        $this->model = $this->favoritedBy($this->auth()->user());

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
