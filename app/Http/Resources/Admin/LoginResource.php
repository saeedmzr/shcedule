<?php


namespace App\Http\Resources\Admin;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class LoginResource extends JsonResource
{
    public static $wrap = null;

    public function toArray($request)
    {
        return [
            'message' => $this['message'],
        ];
    }

    public function toResponse($request)
    {
        return parent::toResponse($request)->setStatusCode($this['status_code']);
    }
}
