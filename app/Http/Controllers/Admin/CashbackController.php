<?php

namespace App\Http\Controllers\Admin;

use App\Models\Cashback;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class CashbackController extends Controller
{
    public function index()
    {
        $ava  = Auth::user()->profile->photo;
        $data = Cashback::orderBy('id', 'Desc')->get();
        return view('dashboard.transaction.index', ['cashbacks' => $data, 'avatar' => $ava]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
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
        //
    }
}
