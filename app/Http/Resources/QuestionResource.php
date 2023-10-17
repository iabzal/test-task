<?php

namespace App\Http\Resources;

use App\Enums\QuestionEnum;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class QuestionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'title' => $this->title,
            'name' => $this->name,
            'category' => $this->category,
            'created_at' => $this->created_at->format('d.m.Y H:i:s'),
            'status' => QuestionEnum::fromName($this->status),
        ];
    }
}
