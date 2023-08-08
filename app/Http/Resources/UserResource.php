<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\ImageResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'name'=>$this->name,
            'password'=>$this->password,
            'email'=>$this->email,
            'edad'=>$this->edad,
            'Msg'=>'Todo Correcto',
            'status'=>1,
            //'images'=>ImageResource::collection($this->images),

        ];
    }
}
