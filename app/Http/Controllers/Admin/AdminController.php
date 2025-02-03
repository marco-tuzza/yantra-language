<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function settings()
    {
        $role = Auth::user()->role;

        if($role !== 'admin') {
            return abort(403);
        } else {
            return view('admin.settings');
        }
    }
}
