<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NewsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
      return [
            'title' => $this->title,
            'body' => $this->body,
            'created_at'=>$this->created_at,
            'cover_image'=>'http/public/cover_image/'.$this->cover_image
           
        ];
    }
}
