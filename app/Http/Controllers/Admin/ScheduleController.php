<?php

namespace App\Http\Controllers\Admin;

use App\Models\Schedule;
use App\Models\Schedule_category;
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
        return view('dashboard.schedule.index', ['schedules' => $data, 'avatar' => $ava]);
    }

    public function index_day2()
    {
        $ava  = Auth::user()->profile->photo;
        $data = Schedule::orderBy('for_date', 'Asc')->get();
        return view('dashboard.schedule.index', ['schedules' => $data, 'avatar' => $ava]);
    }

    public function index_category()
    {
        $ava  = Auth::user()->profile->photo;
        $data = Schedule_category::orderBy('id', 'Desc')->get();
        return view('dashboard.schedule.index', ['categories' => $data, 'avatar' => $ava]);
    }

    public function create()
    {
        $ava  = Auth::user()->profile->photo;
        $data = Speaker::orderBy('name', 'Asc')->get();
        
        return view('dashboard.schedule.create', ['speakers' => $data, 'avatar' => $ava]);
    }

    public function store(Request $request)
    {
        $url = $request->path();

        Schedule::create([
            'speaker_id'  => $request->speaker,
            'category'    => $request->category,
            'name'        => $request->name,
            'description' => $request->description
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
        //
    }
}
