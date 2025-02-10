<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    /**
     * @return Factory|Application|View
     */
    public function settings(): Factory|Application|View
    {
        $role = Auth::user()->role;

        if($role !== 'admin') {
            return abort(403);
        } else {
            $languages = (new LanguageController)->getLanguages();
            $users = (new UserController)->getUsers();

            return view('admin.settings')->with('languages', $languages)->with('users', $users);
        }
    }
    }
