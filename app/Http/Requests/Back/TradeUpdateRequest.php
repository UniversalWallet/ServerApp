<?php

namespace App\Http\Requests\Back;

use App\Http\Requests\BaseRequest;
use App\Models\Trade;
use Carbon\Carbon;

class TradeUpdateRequest extends BaseRequest
{
    protected $model = Trade::class;
    protected $methodKey = 'update';

    protected function getRulesAdditions()
    {
        $data = [
            'starts_at' => '|after:'.Carbon::now()->addHour()->toDateTimeString(),
            'ends_at'   => '|after:'.Carbon::createFromFormat('d.m.Y H:i', $this->input('starts_at'))->addHour()->toDateTimeString()
        ];
        if ($this->input('deadline_at')) {
            $data['deadline_at'] = '|after:'.Carbon::createFromFormat('d.m.Y H:i', $this->input('ends_at'))->subSecond()->toDateTimeString();
        }
        return $data;
    }
}
