<?php

namespace App\Http\Requests\Back;

use App\Http\Requests\BaseRequest;
use App\Models\Trade;
use Carbon\Carbon;

class TradeStoreRequest extends BaseRequest
{
    protected $model = Trade::class;
    protected $methodKey = 'store';

    protected function getRulesAdditions()
    {
        return [
            'starts_at'   => '|after:'.Carbon::now()->addHour()->toDateTimeString(),
            'ends_at'     => '|after:'.Carbon::createFromFormat('d.m.Y H:i', $this->input('starts_at'))->addHour()->toDateTimeString(),
            'deadline_at' => '|after:'.Carbon::createFromFormat('d.m.Y H:i', $this->input('ends_at'))->subSecond()->toDateTimeString()
        ];
    }
}
