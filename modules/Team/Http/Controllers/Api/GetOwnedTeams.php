<?php

namespace Team\Http\Controllers\Api;

use Core\Http\Controllers\Api\ApiController;
use Illuminate\Http\Request;
use Team\Http\Requests\OwnedTeamRequest;
use Team\Http\Resources\OwnedTeamResource;
use Team\Services\TeamServiceInterface;

class GetOwnedTeams extends ApiController
{
    /**
     * Handle the incoming request.
     *
     * @param  \Team\Http\Requests\OwnedTeamRequest $request
     * @param  \Team\Services\TeamServiceInterface  $service
     * @return \Illuminate\Http\Response
     */
    public function __invoke(OwnedTeamRequest $request, TeamServiceInterface $service)
    {
        return OwnedTeamResource::collection($service->list());
    }
}
