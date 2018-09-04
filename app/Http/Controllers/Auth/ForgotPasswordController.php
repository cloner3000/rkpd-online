<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function sendResetLinkFailedResponse(Request $request, $response)
    {
        return back()->withErrors([
            'email'  => trans($response),
            'forget' => true
        ]);
    }

    public function sendResetLinkEmail(Request $request)
    {
        $validator = Validator::make($request->only('email'), [
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            $error = $validator->errors()->first();
            return back()->withErrors(['email' => $error, 'forget' => true]);
        } else {
            $response = $this->broker()->sendResetLink($request->only('email'));
            return $response == Password::RESET_LINK_SENT
                ? $this->sendResetLinkResponse($response)
                : $this->sendResetLinkFailedResponse($request, $response);
        }
    }
}
