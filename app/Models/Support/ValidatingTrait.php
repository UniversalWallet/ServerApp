<?php

namespace App\Models\Support;

trait ValidatingTrait
{
    /**
     * Retrieve validation rules for model action (store, update etc.)
     *
     * @param $key
     * @param array $additions
     * @return array
     */
    public static function getRulesFor($key, $additions = [])
    {
        if (isset(static::$ruleset) && is_array(static::$ruleset) && array_key_exists($key, static::$ruleset)) {
            $rules = static::$ruleset[$key];
            foreach ($additions as $attribute => $addition) {
                if (array_key_exists($attribute, $rules)) {
                    $rules[$attribute] .= $addition;
                } else {
                    $rules[$attribute] = $addition;
                }
            }
        } else {
            $rules = [];
        }
        return $rules;
    }

    /**
     * Get custom validation messages for this model
     *
     * @return array
     */
    public static function getValidationMessages()
    {
        if (isset(static::$validationMessages)) {
            if (is_array(static::$validationMessages)) {
                $messages = static::$validationMessages;
            } else {
                $messages = (array) trans(strval(static::$validationMessages));
            }
        } else {
            $messages = [];
        }

        return $messages;
    }
}
