<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Profile;
use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class VoucherController extends Controller
{
    public function index()
    {
        $ava  = Auth::user()->profile->photo;
        $data = Voucher::orderBy('id', 'Desc')->get();
        return view('dashboard.voucher.index', ['vouchers' => $data, 'avatar' => $ava]);
    }

    public function create()
    {
        $ava  = Auth::user()->profile->photo;
        $data = User::where('role', '2')->orderBy('id', 'Asc')->get();
        return view('dashboard.voucher.create', ['merchants' => $data, 'avatar' => $ava]);
    }

    public function store(Request $request)
    {
        $url = $request->path();

        $file     = $request->file('photo');
        $fileName = Carbon::now()->timestamp . uniqid() . '.' . $file->getClientOriginalExtension();
        $file->storeAs('public/voucher', $fileName);
        
        Voucher::create([
            'merchant_id'  => $request->merchant,
            'name'         => $request->name,
            'description'  => $request->description,
            'expire'       => $request->expire,
            'min_purchase' => $request->min_purchase,
            'cashback'     => $request->cashback,
            'max_cashback' => $request->max_cashback,
            'photo'        => $fileName
        ]);

        return redirect($url)->with('success', 'Berhasil Menambahkan Data');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        Voucher::find($id)->delete();

        return back();
    }
}
