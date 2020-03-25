<?php

namespace Team\Exports;

use Core\Application\Service\WithService;
use Customer\Models\Customer;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Team\Http\Resources\OwnedTeamResource;
use Team\Models\Team;
use Team\Services\TeamServiceInterface;
use User\Models\User;

class TeamsExport implements FromView
{
    use WithService;

    /**
     * Create a new controller instance.
     *
     * @param \Team\Services\TeamServiceInterface $service
     */
    public function __construct(TeamServiceInterface $service)
    {
        $this->service = $service;
    }

    /**
     * Retrieve data from view.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function view(): View
    {
        return view('team::reports.teams')->withData(
            OwnedTeamResource::collection($this->service->onlyManaged())
        );
    }
}
