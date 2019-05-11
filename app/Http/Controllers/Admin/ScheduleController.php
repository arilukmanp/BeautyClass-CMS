<?php

namespace App\Http\Controllers\Admin;

use App\Models\Schedule;
use App\Models\Speaker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ScheduleController extends Controller
{
    public function index_day1()
    {
        $ava  = Auth::user()->profile->photo;
        $data = Schedule::orderBy('for_date', 'Asc')->get();
        return view('dashboard.schedule.index', ['schedule' => $data, 'avatar' => $ava]);
    }

    public function index_day2()
    {
        $ava  = Auth::user()->profile->photo;
        $data = Schedule::orderBy('for_date', 'Asc')->get();
        return view('dashboard.schedule.index', ['schedule' => $data, 'avatar' => $ava]);
    }

    public function create()
    {
        $url = $request->path();

        if ($url == 'bantul') {
            $district = '1';
        }
        else if ($url == 'gunungkidul') {
            $district = '2';
        }

        Destination::create([
            'speaker_id'  => $request->speaker,
            'for_date'    => $request->date,
            'category'    => $request->category,
            'name'        => $request->name,
            'description' => $request->description
        ]);

        return redirect($url)->with('success', 'Berhasil Menambahkan Data');
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
