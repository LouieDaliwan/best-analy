<?php

namespace Best\Http\Controllers\Api\Ldap;

use Illuminate\Http\Request;
use Core\Http\Controllers\Controller;
use Adldap\Laravel\Facades\Adldap;

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
        $ldapuser = Adldap::search()->get();

        return response()->json([
            'status' => 'success',
            'user' => $ldapuser,
        ]);
    }
}
