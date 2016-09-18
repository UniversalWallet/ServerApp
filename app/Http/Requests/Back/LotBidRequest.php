<?php

namespace App\Http\Requests\Back;

use App\Http\Requests\BaseRequest;
use App\Models\Bid;

class LotBidRequest extends BaseRequest
{
    protected $model = Bid::class;
    protected $methodKey = 'store';
}
