<?php

namespace App\Rules;

use App\Category;
use Illuminate\Contracts\Validation\Rule;

class RestoCategoryValidate implements Rule
{
    private $restoId;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($restoId)
    {
        $this->restoId = $restoId;
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
        if (Category::where('name', $value)->where('resto_id', $this->restoId)->first()) {
            return true;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The validation error message.';
    }
}
