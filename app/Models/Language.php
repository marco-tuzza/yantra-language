<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = ['name', 'code'];

    /**
     * The table associated with the model.
     */
    protected $table = 'languages';

    /**
     * Get the users for the language.
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
