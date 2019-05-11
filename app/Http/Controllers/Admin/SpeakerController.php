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
        return view('dashboard.speaker.index', ['speaker' => $data, 'avatar' => $ava]);
    }

    public function create()
    {
        $ava  = Auth::user()->profile->photo;
        return view('dashboard.speaker.create', ['avatar' => $ava]);
    }

    public function store(Request $request)
    {
        $url = $request->path();
        
        $this->validate($request, [
            'email'    => 'required|unique:users'
        ]);
        
        $file     = $request->file('photo');
        $fileName = Carbon::now()->timestamp . uniqid() . '.' . $file->getClientOriginalExtension();
        $file->storeAs('public/profiles', $fileName);

        $profile = new Profile;
        $profile->name           = $request->name;
        $profile->place_of_birth = $request->place_of_birth;
        $profile->date_of_birth  = $request->date_of_birth;
        $profile->phone          = $request->phone;
        $profile->address        = $request->address;
        $profile->photo          = $fileName;
        
        $user           = new User;
        $user->email    = $request->email;
        $user->password = bcrypt('beautyclass123');
        
        $user->save();
        $profile->user()->associate($user);
        $profile->save();

        Mail::to($user->email)->send(new userRegistered($user));

        return redirect($url)->with('success', 'Berhasil Menambahkan Data');
    }

    public function show($id)
    {
        $ava  = Auth::user()->profile->photo;
        $data = User::findOrFail($id);

        return view('dashboard.speaker.single', ['participant' => $data, 'avatar' => $ava]);
    }

    public function edit($id)
    {
        $ava  = Auth::user()->profile->photo;
        $data = User::findOrFail($id);

        return view('dashboard.speaker.edit', ['participant' => $data, 'avatar' => $ava]);
    }

    public function update(Request $request, $id)
    {
        $url = $request->path();
        
        $this->validate($request, [
            'email'    => 'required'
        ]);

        if ($request->hasFile('photo')) {
            $this->validate($request, [
                'photo'    => 'mimes:jpeg,jpg,png|max:1000'
            ]);

            $file     = $request->file('photo');
            $fileName = Carbon::now()->timestamp . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/profiles', $fileName);

            $oldPhoto     = Profile::where('user_id', $id)->value('photo');
            $oldPhotoPath = '/profiles/'.$oldPhoto;

            if (Storage::disk('public')->exists($oldPhotoPath)) {
                Storage::disk('public')->delete($oldPhotoPath);
            }

            $profile        = Profile::where('user_id', $id)->first();
            $profile->photo = $fileName;
            $profile->save();
        }

        $profile = Profile::where('user_id', $id)->first();
        $profile->name           = $request->name;
        $profile->place_of_birth = $request->place_of_birth;
        $profile->date_of_birth  = $request->date_of_birth;
        $profile->phone          = $request->phone;
        $profile->address        = $request->address;
        $profile->save();
        
        $user        = User::where('id', $id)->first();
        $user->email = $request->email;
        $user->save();

        return redirect($url)->with('success', 'Berhasil Memperbarui Data');
    }

    public function destroy($id)
    {
        User::find($id)->delete();

        return back();
    }
}
