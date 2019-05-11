<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class MerchantController extends Controller
{
    public function index()
    {
        $ava  = Auth::user()->profile->photo;
        $data = User::where('role', '2')->get();
        return view('dashboard.merchant.index', ['merchants' => $data, 'avatar' => $ava]);
    }

    public function create()
    {
        $ava  = Auth::user()->profile->photo;
        return view('dashboard.merchant.create', ['avatar' => $ava]);
    }

    public function store(Request $request)
    {
        $url = $request->path();

        // $this->validate($request, [
        //     'profile_picture'    => 'required|image|max:1000'
        // ]);

        // $status = "";
        // $fileName = '';
        if ($request->hasFile('profile_picture')) {
            $file     = $request->file('profile_picture');
            $fileName = Carbon::now()->timestamp . uniqid() . '.' . $file->guessExtension();
            $file->storeAs('public/profiles', $fileName);

            // dd("ok");
            // $status = "uploaded";
            // return response($status,200);
        

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
        $user->role     = '2';
        
        $user->save();
        $profile->user()->associate($user);
        $profile->save();

        // Mail::to($user->email)->send(new userRegistered($user));
        
        return redirect($url)->with('success', 'Berhasil Menambahkan Data');
        }
        dd("no photo");
    }

    public function show($id)
    {
        $ava  = Auth::user()->profile->photo;
        $data = User::findOrFail($id);

        return view('dashboard.merchant.single', ['merchant' => $data, 'avatar' => $ava]);
    }

    public function edit($id)
    {
        $ava  = Auth::user()->profile->photo;
        $data = User::findOrFail($id);

        return view('dashboard.merchant.edit', ['merchant' => $data, 'avatar' => $ava]);
    }

    public function update(Request $request, $id)
    {
        $url = $request->path();

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
