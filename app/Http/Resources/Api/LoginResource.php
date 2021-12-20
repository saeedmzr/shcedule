<?php


namespace App\Http\Resources\Api;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class LoginResource extends JsonResource
{
    public static $wrap = null;

    public function toArray($request)
    {
        return [
            'errors' => $this['errors'] ,
            'data' => $this['data']
        ];
    }

    public function toResponse($request)
    {
        return parent::toResponse($request)->setStatusCode($this['status_code']);
    }
}
