<?php

namespace Core\Http\Controllers\Api\Auth;

use Core\Http\Controllers\Api\ApiController;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use User\Http\Resources\User as UserResource;

class LoginController extends ApiController
{
    /**
     *--------------------------------------------------------------------------
     * Login Controller
     *--------------------------------------------------------------------------
     *
     * This controller handles authenticating users for the application and
     * redirecting them to your home screen. The controller uses a trait
     * to conveniently provide its functionality to your applications.
     *
     */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin';

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return 'username';
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view('theme::auth.login');
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $token = $request->user()->token();

        return response()->json($token->revoke());
    }

    /**
     * Send the response after the user was authenticated.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    protected function sendLoginResponse(Request $request)
    {
        $this->clearLoginAttempts($request);

        return $this->authenticated($request, $this->guard()->user());
    }

    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \User\Models\User        $user
     * @return \Illuminate\Http\Response
     */
    protected function authenticated(Request $request, $user)
    {
        return response()->json([
            'user' => new UserResource($request->user()),
            'token' => $user->createToken($user->username)->accessToken,
        ]);
    }
}
