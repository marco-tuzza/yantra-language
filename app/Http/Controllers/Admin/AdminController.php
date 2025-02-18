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

    /**
     * @param int $id
     * @return Factory|Application|View
     */
    public function editUser(int $id): Factory|Application|View
    {
        $role = Auth::user()->role;

        if ($role !== 'admin') {
            return abort(403);
        } else {
            $user = (new UserController)->getUser($id);
            $languages = (new LanguageController)->getLanguages();
            $userLanguages = $user->languages->pluck('id')->toArray();

            return view('admin.edit-user')->with('user', $user)->with('languages', $languages)->with('userLanguages', $userLanguages);
        }
    }
}
