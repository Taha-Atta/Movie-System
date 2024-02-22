<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Payment;
use App\Models\Customer;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PaidMiddelware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        // $user = auth('api')->user();
        // $paymentStatus = $user->payments->status;



        $user = auth('api')->user();
        $customer = Customer::where('user_id', $user->id)->first();

        $payment = Payment::where('customer_id',$customer->id)->first();
            // dd($payment->status);
        if ($payment->status === 1) {
            return $next($request);
        } else {
            return response()->json([
                'msg' => 'must be paid first',
                'status' => 403
            ], 403);
        }
    }
}
