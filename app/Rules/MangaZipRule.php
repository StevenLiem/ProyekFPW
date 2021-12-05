<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use ZipArchive;

class MangaZipRule implements Rule
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
        $zip = new ZipArchive();

        $status = $zip->open($value->path());
        if ($status !== true) {
            return false;
        }

        for( $i = 0; $i < $zip->numFiles; $i++ ){
            $expectedJpg = $i+1 . ".jpg";
            $expectedPng= $i+1 . ".png";
            $stat = $zip->statIndex( $i );
            if ($stat['name'] != $expectedJpg && $stat['name'] != $expectedPng){
                $zip->close();
                return false;
            }
        }

        $zip->close();
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Please follow the guide for zip file above.';
    }
}
