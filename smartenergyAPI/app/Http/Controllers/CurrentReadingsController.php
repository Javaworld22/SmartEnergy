<?php

namespace App\Http\Controllers;

use App\Current_readings;
use App\Payments;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CurrentReadingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request)
    {
        $data['meter_no'] = $request->input('meter_no');
        $data['address'] = $request->input('address');
        $data['voltage'] = $request->input('voltage');
        $data['current'] = $request->input('current');
        $data['is_active'] = $request->input('is_active');
        $data['temper'] = $request->input('temper');
        $data['time'] = $request->input('time');
        $data['power_factor'] = $request->input('power_factor');
        $data['real_power'] = ($data['voltage'] * $data['current'] * $data['power_factor']) / 1000;
        $data['energy'] = ($data['real_power'] * $data['time']) / 3600;
        $data['user_id'] = $request->input('user_id');
        $data['apparent_power'] = $data['voltage'] * $data['current'];
        $data['angle'] = rad2deg(acos($data['power_factor']));
        $data['reactive_factor'] = sin(deg2rad($data['angle']));
        $data['reactive_power'] = $data['reactive_factor'] * $data['apparent_power'];
        $user = $this->create($data);
        if ($user) {
            return response()->json(['Message' => $user->toArray()], '200');
        } else {
            return response()->json(['Message' => 'Something went wrong in our server'], '500');
        }
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list(Current_readings $current_readings)
    {
        $data = Current_readings::select('*')->get();

        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function last(Current_readings $current_readings)
    {
        $LastData = Current_readings::orderBy('created_at', 'desc')->take(1)->get();

        return response()->json($LastData);
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function payment(Request $request)
    {
        $pay['meter_no'] = $request->input('meter_no');
        $pay['amount'] = $request->input('amount');
        $pay['token'] = '23'.Str::randomTwentyDigit();
        $pay['energy_amount'] = $pay['amount'] / 5;
        $payment = $this->paycreate($pay);
        if ($payment) {
            return response()->json(['Message' => $payment->toArray()], '200');
        } else {
            return response()->json(['Message' => 'Something went wrong in our server'], '500');
        }
    }

    public function paycreate($pay)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function paymentList()
    {
        $paylist = Payments::select('*')->get();

        return response()->json($paylist);
    }

    public function used_energy()
    {
    }
}
