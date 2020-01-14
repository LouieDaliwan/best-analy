<?php

namespace Core\Application\Service\Concerns;

use Illuminate\Http\Response;

trait HaveAuthorization
{
    /**
     * Check if user is authorized to make changes
     * to this resource.
     *
     * @param  mixed  $model
     * @param  string $group
     * @return boolean
     */
    public function authorize($model = null, $group = null): bool
    {
        if ($isAuthorized = $this->auth()->user()->isSuperAdmin()) {
            return $isAuthorized;
        }

        if ($unrestricted = $this->auth()->user()->isUnrestricted($group ?? $this->getTable())) {
            return $unrestricted;
        }

        if (is_object($model) && ! is_null($model->user)) {
            return $this->auth()->user()->getKey() === $model->user->getKey();
        }

        if ((is_null($model) && $this->request()->has('id')) || $this->request()->has('id')) {
            foreach ($this->withTrashed()->whereIn(
                'id', (array) $this->request()->input('id')
            )->get() as $model) {
                if ($this->auth()->user()->getKey() !== $model->user->getKey()) {
                    return abort(Response::HTTP_FORBIDDEN);
                }
            }

            return $authorized = true;
        }

        if (is_null($model)) {
            return $this->auth()->user()->can($this->request->route()->getName());
        }

        return $this->auth()->user()->getKey() === $this->withTrashed()->whereId($model)->firstOr(function () {
            return abort(Response::HTTP_FORBIDDEN);
        })->user->getKey();
    }
}
