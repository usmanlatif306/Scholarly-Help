<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Notifications\SuccessfullLoginNotification;
use App\Notifications\SuccessfullWriterLoginNotification;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\VerifiesEmails;
use App\Order;
use App\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */

    use VerifiesEmails;

    /**
     * Where to redirect users after verification.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Mark the authenticated user's email address as verified.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function verify(Request $request)
    {
        if (!$request->user()) {
            $user = User::findOrFail($request->route('id'));
            auth()->login($user);
        }

        if (!hash_equals((string) $request->route('id'), (string) $request->user()->getKey())) {
            throw new AuthorizationException;
        }

        if (!hash_equals((string) $request->route('hash'), sha1($request->user()->getEmailForVerification()))) {

            throw new AuthorizationException;
        }

        if ($request->user()->hasVerifiedEmail()) {
            return $request->wantsJson()
                ? new JsonResponse([], 204)
                : redirect($this->redirectPath());
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
            if ($request->user()->hasRole('staff')) {
                $request->user()->notify(new SuccessfullWriterLoginNotification($request->user()));
            } else {
                $request->user()->notify(new SuccessfullLoginNotification($request->user()));
            }

            if (session('orderId')) {
                $id = session('orderId');
                $order = Order::where('id', $id)->first();
                $order->customer_id = auth()->user()->id;
                $order->save();
                $request->session()->forget('orderId');
                return redirect()->route('choose_writer', $order->id);
            }
        }

        if ($response = $this->verified($request)) {
            if (session('orderId')) {
                $id = session('orderId');
                $order = Order::where('id', $id)->first();
                $order->customer_id = auth()->user()->id;
                $order->save();
                $request->session()->forget('orderId');
                return redirect()->route('choose_writer', $order->id);
            }
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect($this->redirectPath())->with('verified', true);
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }
}
