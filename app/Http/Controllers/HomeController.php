<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function stripe_payment(Request $request)
    {
        try {
            $stripe = new \Stripe\StripeClient('sk_test_51KWJ4KSJGBX5t2vVri6YCeBQ5FXPPj2EzrnkhJEXPY7oGXHOvsKFirHxwQ5rO4LVMRE2Iy9Dcfjjc4suo1VvxTd900dcRfaH9t');
            $token = $stripe->tokens->create([
                'card' => [
                    'number' => '4242424242424242',
                    'exp_month' => 1,
                    'exp_year' => 2024,
                    'cvc' => '314',
                ],
            ]);
            $charge = $stripe->charges->create([
                'amount' => 2000,
                'currency' => 'usd',
                'source' => 'tok_mastercard',
                'description' => 'My First Test Charge (created for API docs at https://www.stripe.com/docs/api)',
            ]);
            dd($charge);
        } catch (Exception $e) {
            dd('error', $e->getMessage());
        } catch (\Cartalyst\Stripe\Exception\CardErrorException $e) {
            dd('error', $e->getMessage());
        } catch (\Cartalyst\Stripe\Exception\MissingParameterException $e) {
            dd('error', $e->getMessage());
        }
    }
}
