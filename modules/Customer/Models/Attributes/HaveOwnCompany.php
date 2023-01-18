<?php

namespace Customer\Models\Attributes;

trait HaveOwnCompany
{
    public function ownedCompany()
    {
        if (! $this->userIsSuperAdmin()) {

            $userId = $this->auth()->id();


            return $this->model->whereHas('users', function($q) use ($userId) {
                return $q->where('user_id', $userId);
            });
        }

        return $this->model;
    }
}
