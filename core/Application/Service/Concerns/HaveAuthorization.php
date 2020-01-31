<?php

namespace Core\Application\Service\Concerns;

use Illuminate\Http\Response;
use Illuminate\Support\Str;

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
        if (! $this->auth()->check()) {
            return $notLoggedIn = false;
        }

        if ($isAuthorized = $this->auth()->user()->isSuperAdmin()) {
            return $isAuthorized;
        }

        if ($unrestricted = $this->auth()->user()->isUnrestricted($group ?? $this->getTable())) {
            return $unrestricted;
        }

        if (is_object($model) && ! is_null($model->user)) {
            return $this->auth()->user()->getKey() === $model->user->getKey();
        }

        if (is_null($model) && ! $this->request()->has('id')) {
            return $this->auth()->user()->can(
                $this->removeApiPrefixFromPermission(
                    $this->request->route()->getName()
                )
            );
        }

        $model = $this->canSoftDelete() ? $this->withTrashed() : $this;

        if ($this->request()->has('id')) {
            foreach ($model->whereIn(
                'id', (array) $this->request()->input('id')
            )->get() as $model) {
                if ($this->auth()->user()->getKey() !== $model->user->getKey()) {
                    return abort(Response::HTTP_FORBIDDEN);
                }
            }

            return $authorized = true;
        }

        return $this->auth()->user()->getKey() === $model->whereId($model)->firstOr(function () {
            return abort(Response::HTTP_FORBIDDEN);
        })->user->getKey();
    }

    /**
     * Check if the model can perform soft deletes.
     *
     * @return boolean
     */
    protected function canSoftDelete(): boolean
    {
        return method_exists($this, 'getQualifiedDeletedAtColumn');
    }
}
