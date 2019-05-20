<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Profile;
use App\Models\Presence;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class AttendanceController extends Controller
{
    public function index_day1()
    {
        $ava  = Auth::user()->profile->photo;
        $data = Presence::where('for_day', '1')->orderBy('id', 'Desc')->get();
        return view('dashboard.presence.index', ['presences' => $data, 'avatar' => $ava]);
    }

    public function index_day2()
    {
        $ava  = Auth::user()->profile->photo;
        $data = Presence::where('for_day', '2')->orderBy('id', 'Desc')->get();
        return view('dashboard.presence.index', ['presences' => $data, 'avatar' => $ava]);
    }

    public function attended_day1(Request $id)
    {
        return Presence::create([
            'user_id' => $id,
            'for_day' => '1'
        ]);
    }

    public function attended_day2(Request $id)
    {
        return Presence::create([
            'user_id' => $id,
            'for_day' => '2'
        ]);
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
