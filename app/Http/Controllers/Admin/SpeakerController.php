<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Speaker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class SpeakerController extends Controller
{
    public function index()
    {
        $ava  = Auth::user()->profile->photo;
        $data = Speaker::orderBy('id', 'Desc')->get();
        return view('dashboard.speaker.index', ['speakers' => $data, 'avatar' => $ava]);
    }

    public function create()
    {
        $ava  = Auth::user()->profile->photo;
        return view('dashboard.speaker.create', ['avatar' => $ava]);
    }

    public function store(Request $request)
    {
        $url = $request->path();
        
        $file     = $request->file('photo');
        $fileName = Carbon::now()->timestamp . uniqid() . '.' . $file->getClientOriginalExtension();
        $file->storeAs('public/speakers', $fileName);

        Speaker::create([
            'name'        => $request->name,
            'email'       => $request->email,
            'phone'       => $request->phone,
            'title'       => $request->title,
            'photo'       => $fileName,
            'description' => $request->description
        ]);

        return redirect($url)->with('success', 'Berhasil Menambahkan Data');
    }

    public function show($id)
    {
        return abort('404');
    }

    public function edit($id)
    {
        $ava  = Auth::user()->profile->photo;
        $data = Speaker::findOrFail($id);

        return view('dashboard.speaker.edit', ['speaker' => $data, 'avatar' => $ava]);
    }

    public function update(Request $request, $id)
    {
        $url = $request->segment('1');
        
        $this->validate($request, [
            'email'    => 'required'
        ]);

        if ($request->hasFile('photo')) {
            $this->validate($request, [
                'photo'    => 'mimes:jpeg,jpg,png|max:1000'
            ]);

            $file     = $request->file('photo');
            $fileName = Carbon::now()->timestamp . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/speakers', $fileName);

            $oldPhoto     = Speaker::where('id', $id)->value('photo');
            $oldPhotoPath = '/speakers/'.$oldPhoto;

            if (Storage::disk('public')->exists($oldPhotoPath)) {
                Storage::disk('public')->delete($oldPhotoPath);
            }

            $speaker        = Speaker::where('user_id', $id)->first();
            $speaker->photo = $fileName;
            $speaker->save();
        }

        Speaker::findOrFail($id)->update([
            'name'        => $request->name,
            'email'       => $request->email,
            'phone'       => $request->phone,
            'title'       => $request->title,
            'description' => $request->description
        ]);

        return redirect($url)->with('success', 'Berhasil Memperbarui Data');
    }

    public function destroy($id)
    {
        User::find($id)->delete();

        return back();
    }
}
