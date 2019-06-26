<?php

namespace Core\Application\Repository;

interface RepositoryInterface
{
    /**
     * Retrieve all model resources as array.
     *
     */
    public function all();

    /**
     * Retrieve model collection.
     *
     */
    public function get();

    /**
     * Retrieve model resource details.
     *
     * @param int $id
     */
    public function find(int $id);

    /**
     * Create model resource.
     *
     * @param array $attributes
     */
    public function store(array $attributes);

    /**
     * Update model resource.
     *
     * @param int    $id
     * @param array  $data
     */
    public function update(int $id, array $attributes);

    /**
     * Permanently delete model resource.
     *
     * @param int|array $id
     */
    public function delete($id);

    /**
     * Soft delete model resource.
     *
     * @param int|array $id
     */
    public function destroy($id);

    /**
     * Restore model resource.
     *
     * @param int|array $id
     */
    public function restore($id);
}
