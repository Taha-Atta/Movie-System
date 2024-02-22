<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HistoryRecource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
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
