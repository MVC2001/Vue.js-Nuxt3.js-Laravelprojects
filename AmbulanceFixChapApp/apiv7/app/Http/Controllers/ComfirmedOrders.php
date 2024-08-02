<?php

namespace App\Http\Controllers;
use App\Models\Orders;
use App\Models\User;
use Illuminate\Http\Request;

class ComfirmedOrders extends Controller
{
       public function __construct()
{
    $this->middleware('auth:sanctum')->except(['register', 'login']);
}


//get orderd for logged driver
public function driverOrders(Request $request)
{
    try {
        // Get the logged-in user's route
        $userRoute = $request->user()->route;

        // Retrieve orders with the same route as the user's route and confirm status as "confirmed"
        $orders = Orders::where('route', $userRoute)
                        ->where('confirm', 'confirmed')
                        ->orderBy('id', 'desc')
                        ->get();

        return response()->json($orders, 200);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Internal Server Error'], 500);
    }
}

}
