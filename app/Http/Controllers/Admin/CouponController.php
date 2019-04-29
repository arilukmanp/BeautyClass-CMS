<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class CouponController extends Controller
{
    public function index()
    {
        $ava  = Auth::user()->profile->photo;
        $data = User::where('role', '1')->orderBy('id', 'Desc')->get();
        return view('dashboard.participant.index', ['participants' => $data, 'avatar' => $ava]);
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
