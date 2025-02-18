<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Retrieve all users
     *
     * @return Collection
     */
    public function getUsers(): Collection
    {
        return User::all()->where('role', '!=', 'admin');
    }

    /**
     * Retrieve a specific user
     *
     * @param int $id
     * @return User
     */
    public function getUser(int $id): User
    {
        return User::find($id);
    }

    /**
     * Delete a user
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function deleteUser(Request $request): RedirectResponse
    {
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        $id = $request->route('id');

        $user = User::find($id);

        if ($user) {
            User::destroy($id);
        } else {
            return redirect()->route('admin.settings')->with('user-delete-error', 'User not found');
        }

        return redirect()->route('admin.settings')->with('user-delete-success', 'User deleted successfully');
    }

    /**
     * Update a user
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function updateUser(Request $request): RedirectResponse
    {
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        $id = $request->route('id');

        $user = User::find($id);

        if ($user) {
            $user->update($request->all());
        } else {
            return redirect()->route('admin.settings')->with('user-update-error', 'User not found');
        }

        return redirect()->route('admin.settings')->with('user-update-success', 'User updated successfully');
    }
}
