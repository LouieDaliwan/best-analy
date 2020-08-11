<?php

namespace Best\Http\Controllers\Api\Ldap;

use Adldap\Laravel\Facades\Adldap;
use Best\Models\LdapUser;
use Core\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use User\Models\Role;

class SingleSignonViaActiveDirectory extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');

        config()->set('ldap.connections.default.settings.username', $username.'@khalifafund.gov.ae');
        config()->set('ldap.connections.default.settings.password', $password);

        $ldapuser = Adldap::search()->find($username);

        if ($ldapuser) {
            $ldapuser = $this->updateOrCreateUser($request, $ldapuser);
        }

        return response()->json([
            'status' => 'success',
            'user' => $ldapuser,
            'token' => $ldapuser->createToken($ldapuser->username)->accessToken,
        ]);
    }

    /**
     * Update or create a user.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  array                    $attributes
     * @return \User\Models\User
     */
    protected function updateOrCreateUser($request, $attributes)
    {
        $user = LdapUser::updateOrCreate([
            'username' => $attributes->samaccountname[0]
        ], [
            'firstname' => $attributes->givenname[0],
            'lastname' => $attributes->sn[0],
            'email' => $attributes->userprincipalname[0],
            'username' => $request->input('username'),
            'password' => Hash::make($request->input('password')),
        ]);

        $user->roles()->sync(Role::whereCode('counselor')->first()->getKey());

        if (Auth::attempt($request->only('username', 'password'))) {
            $user = Auth::user();
        }

        return $user;
    }
}
