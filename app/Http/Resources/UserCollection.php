<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class UserCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'data'=>$this->collection->map(function($user)
            {
            return[
                'nombre'=>$user->name,
                'edad'=>$user->edad,
                'images'=>$user->images->map(function($image){
                    return[
                        'url'=>$image->url,
                        'is_visible'=>$image->is_visible,
                    ];
                }),
            ];
         }),
    ];

   }

}
