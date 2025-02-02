<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function settings()
    {
        $role = Auth::user()->role;

        if($role !== 'admin') {
            return abort(403);
        } else {
            return view('auth.settings');
        }
    }
}
