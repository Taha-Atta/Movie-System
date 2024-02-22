<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MovieResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'title'=>$this->title,
            'summery'=>$this->summery,
            'video'=>$this->video,
            'image'=>$this->image,
            'duration'=>$this->duration,
            'lanchYear'=>$this->lanchYear,
            'isFree'=>$this->isFree,
        ];

    }
}
