<?php

namespace Core\Application\Service\Concerns;

use Illuminate\Support\Facades\Schema;

trait HaveSortOrder
{
    /**
     * Sort and order based on the url parameters.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function sortAndOrder()
    {
        return $this->model()->orderBy(
            $this->getFilteredSortKey(),
            $this->getFilteredOrderKey()
        );
    }

    /**
     * Retrieve the sort key from url parameter
     * and check if it exists as attribute or column.
     *
     * @param  string|null $default
     * @return string
     */
    protected function getFilteredSortKey($default = 'id')
    {
        $key = $this->request()->get('sort') ?? $default;

        return in_array($key, Schema::getColumnListing($this->getTable())) ? $key : $this->getKeyName();
    }

    /**
     * Retrieve the order key from url.
     *
     * @return string
     */
    protected function getFilteredOrderKey()
    {
        return $this->request()->get('order') ?? 'asc';
    }
}
