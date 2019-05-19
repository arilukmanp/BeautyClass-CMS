<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Profile;
use App\Models\Reg_payment;
use App\Mail\userRegistered;
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
        $data = User::where([['role', '1'], ['status', '1']])->orderBy('id', 'Desc')->get();
        return view('dashboard.participant.index', ['participants' => $data, 'avatar' => $ava]);
    }

    public function index_confirmation()
    {
        $ava  = Auth::user()->profile->photo;
        $data = Reg_payment::orderBy('id', 'Desc')->get();
        return view('dashboard.participant.index', ['participants' => $data, 'avatar' => $ava]);
    }

    public function index_registered()
    {
        $ava  = Auth::user()->profile->photo;
        $data = User::where([['role', '1'], ['status', '2']])->orderBy('id', 'Desc')->get();
        return view('dashboard.participant.index', ['participants' => $data, 'avatar' => $ava]);
    }

    public function create()
    {
        $ava  = Auth::user()->profile->photo;
        return view('dashboard.participant.create', ['avatar' => $ava]);
    }

    public function store(Request $request)
    {
        $url = $request->path()."/all";
        
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
        $user->token    = str_random(20);
        
        $user->save();
        $profile->user()->associate($user);
        $profile->save();

        Mail::to($user->email)->queue(new userRegistered($user));

        return redirect($url)->with('success', 'Berhasil Menambahkan Data');
    }

    public function show($id)
    {
        $ava  = Auth::user()->profile->photo;
        $data = User::findOrFail($id);

        return view('dashboard.participant.single', ['participant' => $data, 'avatar' => $ava]);
    }

    public function show_confirmation($id)
    {
        $ava  = Auth::user()->profile->photo;
        $data = Reg_payment::findOrFail($id);

        return view('dashboard.participant.single', ['participant' => $data, 'avatar' => $ava]);
    }

    public function edit($id)
    {
        $ava  = Auth::user()->profile->photo;
        $data = User::findOrFail($id);

        return view('dashboard.participant.edit', ['participant' => $data, 'avatar' => $ava]);
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

    public function confirm(Request $request, $id)
    {
        $url   = url('/'.$request->segment('1').'/'.$request->segment('2'));
        // dd($url);
        $email = Reg_payment::findOrFail($id)->first()->email;

        // dd(User::where('email', $email)->count());

        if (User::where('email', $email)->first() == 0) {
            return redirect($url)->with('warning', 'Tidak ada data user yang cocok dengan email pengirim');
        }
        else {
            User::where('email', $email)->update([
                'status' => '2'
            ]);

            Reg_payment::find($id)->delete();
            
            return redirect($url)->with('success', 'Berhasil Mengkonfirmasi Data');
        }
    }

    public function destroy($id)
    {
        User::find($id)->delete();

        return back();
    }
}
