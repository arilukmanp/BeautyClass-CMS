<?php

namespace App\Http\Controllers\Admin;

use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $ava = Auth::user()->profile->photo;

        if (!Gate::allows('isEO')) {
            // return abort(403);
            return view('dashboard.home.index', ['avatar' => $ava]);
        }

        return view('dashboard.home.index', ['avatar' => $ava]);
    }
}
