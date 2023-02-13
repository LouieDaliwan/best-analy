<?php

namespace Customer\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use User\Models\User;

class AssignUser
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $keys = ['BusinessCounselorEmail', 'PeeBusinessCounselorEmail'];

        $customer = $event->customer;

        $customer->users()->detach();

        $metadata = $event->applicant->metadata;


        foreach ($keys as $key) {
            if(!isset($metadata[$key])) continue;

            if ($metadata[$key] != null ) {
                $user = User::whereEmail($metadata[$key])->first();

                if ($user) {
                    $customer->users()->attach($user->id);
                }
            }
        }
    }
}
