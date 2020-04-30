<?php

namespace Best\Http\Controllers\Api\Ldap;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Metrogistics\AzureSocialite\AuthController;
use User\Http\Resources\User as UserResource;
use User\Models\Role;

class LoginController extends AuthController
{
    /**
     * Get the needed authorization credentials from the request.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    protected function credentials(Request $request)
    {
        return [
            'mail' => $request->get('email'),
            'password' => $request->get('password'),
        ];
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \User\Models\User
     */
    public function login(Request $request)
    {
        $user = json_decode(json_encode($request->all()), false);

        $authUser = $this->findOrCreateUser($user);

        $roles = Role::whereCode('counselor')->orWhere('code', 'advisor')->pluck('id')->toArray();
        $roles = array_merge($roles, $authUser->roles->pluck('id')->toArray());

        $authUser->roles()->sync($roles);

        $authUser = \User\Models\User::find($authUser->getKey());

        return response()->json([
            'user' => new UserResource($authUser),
            'token' => $authUser->createToken($authUser->username)->accessToken,
        ]);
    }
}
