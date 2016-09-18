<?php

namespace App\Http\Requests\Back;

use App\Http\Requests\BaseRequest;
use App\Models\User;

class UserUpdateRequest extends BaseRequest
{
    protected $model = User::class;
    protected $methodKey = 'update';

    protected function getRulesAdditions()
    {
        return [
            'email' => ','.$this->route('id')
        ];
    }
}
