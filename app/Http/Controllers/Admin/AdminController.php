<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\RedirectResponse;
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
            $languages = $this->getLanguages();
            return view('admin.settings')->with('languages', $languages);
        }
    }

    /**
     * Add a new language
     *
     * @param Request $request
     * @return RedirectResponse
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

        return redirect()->route('admin.settings')->with('language-add-success', 'New language added');
    }

    /**
     * Retrieve all languages
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getLanguages() {
        return Language::all();
    }

    /**
     * Delete a language
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function deleteLanguage(Request $request): RedirectResponse
    {
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        $id = $request->route('id');

        $language = Language::find($id);

        if ($language) {
            Language::destroy($id);
        } else {
            return redirect()->route('admin.settings')->with('language-delete-error', 'Language not found');
        }

        return redirect()->route('admin.settings')->with('language-delete-success', 'Language deleted successfully');
    }

}
