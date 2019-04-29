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
        // $this->validate($request, [
        //     'profile_picture'    => 'required|image|max:1000'
        // ]);

        // $status = "";

        if ($request->hasFile('profile_picture')) {

            $file     = $request->file('profile_picture');
            $fileName = Carbon::now()->timestamp . uniqid() . '.' . $file->guessExtension();
            $file->storeAs('public/profiles', $fileName);

            // dd("ok");
            // $status = "uploaded";
        

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
        
        return redirect('merchants');
        }
        dd("no photo");
        // return response($status,200);
    }

    public function show($id)
    {
        $ava  = Auth::user()->profile->photo;
        $data = User::find($id);

        if(!$data)
            abort(404);

        return view('dashboard.participant.single', ['participant' => $data, 'avatar' => $ava]);
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
