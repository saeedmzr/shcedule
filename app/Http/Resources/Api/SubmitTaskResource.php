<?php


namespace App\Http\Resources\Api;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class SubmitTaskResource extends JsonResource
{
    public static $wrap = null;

    public function toArray($request)
    {
        return [
            'errors' => $this['errors'],
            'data' => $this['data'] ,
            'message' => $this['message']
        ];
    }

    public function toResponse($request)
    {
        return parent::toResponse($request)->setStatusCode($this['status_code']);
    }
}
