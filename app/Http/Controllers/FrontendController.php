<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Hit;
use App\Models\Reg_payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FrontendController extends Controller
{
    public function index()
    {   
        $dateNow = Carbon::now()->toDateString();
        
        if (Hit::whereDate('created_at', $dateNow)->first()) {
            Hit::whereDate('created_at', $dateNow)
                ->first()
                ->update(['counter' => DB::raw('counter+1')]);
        }
        else {
            Hit::create(['counter' => '1']);
        }


        return view('frontend.index');
    }

    public function confirmation()
    {
        $dateNow = Carbon::now()->toDateString();
        
        if (Hit::whereDate('created_at', $dateNow)->first()) {
            Hit::whereDate('created_at', $dateNow)
                ->first()
                ->update(['counter' => DB::raw('counter+1')]);
        }
        else {
            Hit::create(['counter' => '1']);
        }

        return view('frontend.confirmation');
    }

    public function store(Request $request)
    {
        $file     = $request->file('photo');
        $fileName = Carbon::now()->timestamp . uniqid() . '.' . $file->getClientOriginalExtension();
        $file->storeAs('public/reg_payments', $fileName);

        Reg_payment::create([
            'name'             => $request->name,
            'email'            => $request->email,
            'to_bank'          => $request->to_bank,
            'bank_account'     => $request->bank_account,
            'amount'           => $request->amount,
            'date_of_transfer' => $request->date_of_transfer,
            'photo'            => $fileName
        ]);

        return redirect('/payment-confirmation')->with('success', 'Terimakasih, pembayaran anda akan segera kami proses');
    }
}
