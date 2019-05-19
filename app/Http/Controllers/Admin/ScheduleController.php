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
        $data = Schedule::where('for_day', '1')->orderBy('time', 'Asc')->get();
        return view('dashboard.schedule.index', ['schedules' => $data, 'avatar' => $ava]);
    }

    public function index_day2()
    {
        $ava  = Auth::user()->profile->photo;
        $data = Schedule::where('for_day', '2')->orderBy('time', 'Asc')->get();
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
        $ava        = Auth::user()->profile->photo;
        $categories = Schedule_category::orderBy('name', 'Asc')->get();
        $speakers   = Speaker::orderBy('name', 'Asc')->get();
        
        return view('dashboard.schedule.create', ['speakers' => $speakers, 'categories' => $categories, 'avatar' => $ava]);
    }

    public function create_category()
    {
        $ava = Auth::user()->profile->photo;
        
        return view('dashboard.schedule.create', ['avatar' => $ava]);
    }

    public function store_day1(Request $request)
    {
        $url = $request->path();

        Schedule::create([
            'category_id' => $request->category,
            'speaker_id'  => $request->speaker,
            'name'        => $request->name,
            'time'        => $request->time,
            'description' => $request->description,
            'for_day'     => '1'
        ]);

        return redirect($url)->with('success', 'Berhasil Menambahkan Data');
    }

    public function store_day2(Request $request)
    {
        $url = $request->path();

        Schedule::create([
            'category_id' => $request->category,
            'speaker_id'  => $request->speaker,
            'name'        => $request->name,
            'time'        => $request->time,
            'description' => $request->description,
            'for_day'     => '2'
        ]);

        return redirect($url)->with('success', 'Berhasil Menambahkan Data');
    }

    public function store_category(Request $request)
    {
        $url = $request->path();

        Schedule_category::create([
            'name'        => $request->name
        ]);

        return redirect($url)->with('success', 'Berhasil Menambahkan Data');
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
        Schedule::find($id)->delete();

        return back();
    }

    public function destroy_category($id)
    {
        Schedule_category::find($id)->delete();

        return back();
    }
}
