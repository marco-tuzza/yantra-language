<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

use App\Models\Language;

class AdminController extends Controller
{
    /**
     * Display the settings page for the admin
     */
    public function settings()
    {
        $role = Auth::user()->role;

        if($role !== 'admin') {
            return abort(403);
        } else {
            return view('admin.settings');
        }
    }

    /**
     * Add a new language
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function addLanguage(Request $request)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        $validator = Validator::make($request->all(), [
            'name' => ['required','string','unique:'.Language::class],
            'code' => ['required','string','unique:'.Language::class],
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator, 'language')
                ->withInput();
        }

        $language = new Language();
        $language->name = ucfirst($request->name);
        $language->code = strtolower($request->code);
        $language->save();

        return redirect()->route('admin.settings')->with('language-success', 'New language added');
    }

}
