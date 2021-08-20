<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class UserPermissionsExists implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        //
        // dd($value['user_id'], $value['permission_id']);
        $hasPivot = DB::table('permisison_user')->where('user_id', $value['user_id'])->where('permission_id', $value['permission_id'])->get();
        if ($hasPivot->count() > 0) {
            return false;
        } else {
            return true;
        };
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Sorry bud. This permissions already exists.';
    }
}
