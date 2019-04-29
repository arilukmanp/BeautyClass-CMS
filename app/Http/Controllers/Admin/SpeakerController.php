<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class SpeakerController extends Controller
{
    public function index()
    {
        $ava  = Auth::user()->profile->photo;
        $data = User::where('role', '1')->orderBy('id', 'Desc')->get();
        return view('dashboard.speaker.index', ['participants' => $data, 'avatar' => $ava]);
    }

    public function create()
    {
        return view('dashboard.speaker.create');
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
        die('hard');
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
