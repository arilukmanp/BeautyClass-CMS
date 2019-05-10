<?php

namespace App\Http\Controllers\Admin;

use Gate;
use App\Models\Hit;
use App\Models\User;
use App\Models\Speaker;
use App\Models\Gallery;
// use App\Models\Voucher;
use App\Models\Download;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $ava         = Auth::user()->profile->photo;
        $hits        = Hit::orderBy('id', 'desc')->take(7)->get([DB::raw('Date(created_at) as date'), DB::raw('counter')])->toJSON();
        $participant = User::where('role', 1)->count();
        $merchant    = User::where('role', 2)->count();
        $speaker     = Speaker::count();
        // $voucher     = Voucher::count();
        $gallery     = Gallery::count();
        $download    = Download::count();
        $transaction = Transaction::count();

        if (!Gate::allows('isEO')) {
            // return abort(403);
            return view('dashboard.home.index', ['avatar' => $ava]);
        }

        return view('dashboard.home.index', ['avatar' => $ava]);
    }
}
