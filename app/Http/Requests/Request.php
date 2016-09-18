<?php

namespace App\Http\Requests;

use App\Library\Support\ResponseTrait;
use Illuminate\Foundation\Http\FormRequest;

abstract class Request extends FormRequest
{
    use ResponseTrait;

    public function authorize()
    {
        return true;
    }

    /**
     * Get the proper failed validation response for the request.
     *
     * @param  array  $errors
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function response(array $errors)
    {
        return $this->error($errors, $this->getRedirectUrl(), [], $this->dontFlash, 422);
    }
}
