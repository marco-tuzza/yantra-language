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
        return User::with('languages')->findOrFail($id);
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
            $userLanguages = $user->languages;
            $user->languages()->detach($userLanguages);
            User::destroy($id);
        } else {
            return redirect()->route('admin.settings')->with('user-delete-error', 'User not found');
        }

        return redirect()->route('admin.settings')->with('user-delete-success', 'User deleted successfully');
    }

    /**
     * Update username and languages for a user
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

        if (!$user) {
            return redirect()->route('admin.edit-user', $id)->with('user-update-error', 'User not found');
        }

        $validatedData = $request->validate([
            'languages' => ['array'],
            'languages.*' => ['exists:languages,id'],
        ]);

        $user->update($request->except('languages'));
        $user->languages()->sync($validatedData['languages']);

        return redirect()->route('admin.edit-user', $id)->with('user-update-success', 'User updated successfully');
    }

}
