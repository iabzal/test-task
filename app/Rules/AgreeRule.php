<?php
// app/Rules/AlwaysTrueRule.php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class AgreeRule implements Rule
{
    /**
     * @param $attribute
     * @param $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        return $value === true;
    }

    /**
     * @return string
     */
    public function message(): string
    {
        return 'Вы должны согласиться с правилами.';
    }
}
