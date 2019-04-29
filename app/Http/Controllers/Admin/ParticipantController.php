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

class ParticipantController extends Controller
{
    public function index_all()
    {
        $ava  = Auth::user()->profile->photo;
        $data = User::where('role', '1')->orderBy('id', 'Desc')->get();
        return view('dashboard.participant.index', ['participants' => $data, 'avatar' => $ava]);
    }

    public function index_unregistered()
    {
        $ava  = Auth::user()->profile->photo;
        $data = User::where('status', '1')->orderBy('id', 'Desc')->get();
        return view('dashboard.participant.index', ['participants' => $data, 'avatar' => $ava]);
    }

    public function index_registered()
    {
        $ava  = Auth::user()->profile->photo;
        $data = User::where('status', '2')->orderBy('id', 'Desc')->get();
        return view('dashboard.participant.index', ['participants' => $data, 'avatar' => $ava]);
    }

    public function create()
    {
        $ava  = Auth::user()->profile->photo;
        return view('dashboard.participant.create', ['avatar' => $ava]);
    }

    public function store(Request $request)
    {
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

        return redirect('participants/all');
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
        $ava  = Auth::user()->profile->photo;
        $data = User::find($id);

        if(!$data)
            abort(404);

        return view('dashboard.participant.edit', ['participant' => $data, 'avatar' => $ava]);
    }

    public function update(Request $request, $id)
    {
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

        return redirect('participants/'.$id);
    }

    public function destroy($id)
    {
        $data = User::find($id);
        $data->delete();

        return redirect('participants/all');
    }

    public function tes()
    {
        if(isset($_POST["image"]))
{
 $data = $_POST["image"];

 $image_array_1 = explode(";", $data);

 $image_array_2 = explode(",", $image_array_1[1]);

 $data = base64_decode($image_array_2[1]);

 $imageName = time() . '.png';

 file_put_contents($imageName, $data);

 echo '<img src="'.$imageName.'" class="img-thumbnail" />';
}
    }
}
