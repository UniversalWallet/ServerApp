<?php

namespace App\Http\Requests;

use App\Models\Support\ValidatingTrait;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRequest extends Request
{
    /** @var Model|ValidatingTrait */
    protected $model;
    protected $methodKey;

    protected function getRulesAdditions()
    {
        return [];
    }

    public function rules()
    {
        return (array) (call_user_func([$this->model, 'getRulesFor'], $this->methodKey, $this->getRulesAdditions()));
    }

    public function messages()
    {
        return (array) (call_user_func([$this->model, 'getValidationMessages']));
    }
}
