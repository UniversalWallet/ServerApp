<?php

if (! function_exists('message_link')) {

    /**
     * Generates link for usage in notification messages.
     *
     * @param string $to
     * @param string $text
     * @return string
     */
    function message_link($to, $text = '')
    {
        return '<a href="'.$to.'">'.$text.'</a>';
    }
}

if (! function_exists('message_note')) {

    /**
     * Generates note for usage in notification messages.
     *
     * @param string $text
     * @return string
     */
    function message_note($text = '')
    {
        return '<i class="hint-text light fs-12">'.$text.'</i>';
    }
}

if (! function_exists('cased_word')) {

    /**
     * Generates cased word.
     *
     * @param int $number
     * @param string $case_one
     * @param string $case_zero_or_many
     * @param string|null $case_234
     * @return null
     */
    function cased_word($number, $case_one, $case_zero_or_many, $case_234 = null)
    {
        $number = (int) $number;
        $cased_word = $case_zero_or_many;
        if ($number % 10 == 1 && ((int)($number / 10)) % 10 !== 1) {
            $cased_word = $case_one;
        } elseif (! is_null($case_234) && in_array($number % 10, [2, 3, 4]) && ($number % 100 < 12 || $number % 100 > 14)) {
            $cased_word = $case_234;
        }
        return $cased_word;
    }
}

if (! function_exists('currency_symbol')) {

    /**
     * Generates currency symbol by its code.
     *
     * @param string|null $currency_code
     * @return string
     */
    function currency_symbol($currency_code = null)
    {
        switch ($currency_code) {
            case 'rub':
                return '₽';
                break;
            case 'usd':
                return '$';
                break;
            case 'eur':
                return '€';
                break;
            default:
                return '';
        }
    }
}

if (! function_exists('pretty_price')) {

    /**
     * Generates pretty price number.
     *
     * @param float $price
     * @param boolean $nbsp
     * @param string|null $currency_code
     * @return string
     */
    function pretty_price($price, $currency_code = null, $nbsp = false)
    {
        $sep = ($nbsp ? '&nbsp;' : ' ');
        $result = preg_replace('/,00$/', '', number_format($price, 2, ',', $sep));
        if ($currency_code) {
            $result = currency_symbol($currency_code).$sep.$result;
        }
        return $result;
    }
}
