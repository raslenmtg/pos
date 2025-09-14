<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Utils\BusinessUtil;
use App\Utils\ModuleUtil;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Rules\ReCaptcha;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * All Utils instance.
     */
    protected $businessUtil;

    protected $moduleUtil;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(BusinessUtil $businessUtil, ModuleUtil $moduleUtil)
    {
        $this->middleware('guest')->except('logout');
        $this->businessUtil = $businessUtil;
        $this->moduleUtil = $moduleUtil;
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Change authentication from email to username
     *
     * @return void
     */
    public function username()
    {
        return 'username';
    }

    public function logout()
    {
        $this->businessUtil->activityLog(auth()->user(), 'logout');

        request()->session()->flush();
        \Auth::logout();

        return redirect('/login');
    }

    /**
     * The user has been authenticated.
     * Check if the business is active or not.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        try {
            \Log::info('User authenticated successfully: ' . $user->username . ' (ID: ' . $user->id . ')');
            
            $this->businessUtil->activityLog($user, 'login', null, [], false, $user->business_id);

            if (! $user->business->is_active) {
                \Log::warning('Login rejected - business inactive for user: ' . $user->username);
                \Auth::logout();

                return redirect('/login')
                  ->with(
                      'status',
                      ['success' => 0, 'msg' => __('lang_v1.business_inactive')]
                  );
            } elseif ($user->status != 'active') {
                \Log::warning('Login rejected - user inactive: ' . $user->username);
                \Auth::logout();

                return redirect('/login')
                  ->with(
                      'status',
                      ['success' => 0, 'msg' => __('lang_v1.user_inactive')]
                  );
            } elseif (! $user->allow_login) {
                \Log::warning('Login rejected - login not allowed for user: ' . $user->username);
                \Auth::logout();

                return redirect('/login')
                    ->with(
                        'status',
                        ['success' => 0, 'msg' => __('lang_v1.login_not_allowed')]
                    );
            } elseif (($user->user_type == 'user_customer') && ! $this->moduleUtil->hasThePermissionInSubscription($user->business_id, 'crm_module')) {
                \Log::warning('Login rejected - no CRM subscription for customer user: ' . $user->username);
                \Auth::logout();

                return redirect('/login')
                    ->with(
                        'status',
                        ['success' => 0, 'msg' => __('lang_v1.business_dont_have_crm_subscription')]
                    );
            }
            
            \Log::info('Login successful for user: ' . $user->username);
        } catch (\Exception $e) {
            \Log::error('Error in authenticated method: ' . $e->getMessage());
            \Log::error('Full error: ' . $e->getTraceAsString());
            throw $e;
        }
    }

    protected function redirectTo()
    {
        $user = \Auth::user();
        if (! $user->can('dashboard.data') && $user->can('sell.create')) {
            return '/pos/create';
        }

        if ($user->user_type == 'user_customer') {
            return 'contact/contact-dashboard';
        }

        return '/home';
    }

    public function validateLogin(Request $request)
    {
        try {
            \Log::info('Login attempt started for user: ' . $request->input('username', 'N/A'));
            
            if(config('constants.enable_recaptcha')){
                \Log::info('ReCaptcha validation enabled');
                $this->validate($request, [
                    $this->username() => 'required|string',
                    'password' => 'required|string',
                    'g-recaptcha-response' => ['required', new ReCaptcha]
                ]);
            }else{
                \Log::info('ReCaptcha validation disabled');
                $this->validate($request, [
                    $this->username() => 'required|string',
                    'password' => 'required|string',
                ]);
            }
            
            \Log::info('Login validation passed for user: ' . $request->input('username', 'N/A'));
        } catch (\Exception $e) {
            \Log::error('Login validation failed: ' . $e->getMessage());
            \Log::error('Full error: ' . $e->getTraceAsString());
            throw $e;
        }
    }

}
