<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Language;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LanguageController extends Controller
{
    /**
     * Retrieve all languages
     *
     * @return Collection
     */
    public function getLanguages(): Collection
    {
        return Language::orderBy('name', 'ASC')->get();
    }

    /**
     * Add a new language
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function addLanguage(Request $request): RedirectResponse
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

        return redirect()->route('admin.settings', ['section' => 'languages'])->with('language-add-success', 'New language added');
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
            $languageUsers = $language->users;
            $language->users()->detach($languageUsers);
            Language::destroy($id);
        } else {
            return redirect()->route('admin.settings', ['section' => 'languages'])->with('language-delete-error', 'Language not found');
        }

        return redirect()->route('admin.settings', ['section' => 'languages'])->with('language-delete-success', 'Language deleted successfully');
    }
}
