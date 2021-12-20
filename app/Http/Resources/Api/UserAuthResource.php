<?php


namespace App\Http\Resources\Api;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class UserAuthResource extends JsonResource
{
    public static $wrap = null;

    public function toArray($request)
    {
        return [

            'access_token' => $this['access_token'] ,
            'message' =>  $this['message'] ,
            'user' => $this['user'],
        ];
    }

    public function toResponse($request)
    {
        return parent::toResponse($request)->setStatusCode(200);
    }
}
